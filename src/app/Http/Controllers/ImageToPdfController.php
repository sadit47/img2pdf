<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class ImageToPdfController extends Controller
{
    public function form()
    {
        return view('img2pdf');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'images'   => ['required', 'array', 'min:1', 'max:50'],
            'images.*' => ['file', 'mimes:jpg,jpeg,png,tif,tiff', 'max:10240'], // 10MB/ไฟล์
        ]);

        $jobId = (string) Str::uuid();
        $workDir = storage_path("app/tmp/{$jobId}");
        if (!is_dir($workDir)) mkdir($workDir, 0775, true);

        // ✅ ตั้งชื่อไฟล์ PDF ให้เหมือนต้นฉบับ (อิงไฟล์แรก)
        $first = $request->file('images')[0];
        $originalBase = pathinfo($first->getClientOriginalName(), PATHINFO_FILENAME);

        // ทำชื่อให้ปลอดภัย (กันช่องว่าง/อักขระพิเศษ) — แนะนำ
        $safeBase = Str::slug($originalBase);
        if ($safeBase === '') $safeBase = 'converted';

        // ถ้าอัปโหลดหลายรูป ใส่ -merged ต่อท้าย (เอาออกได้ถ้าไม่ต้องการ)
        $downloadName = $safeBase . (count($request->file('images')) > 1 ? '-merged' : '') . '.pdf';

        $inputPaths = [];
        foreach ($request->file('images') as $i => $file) {
            $ext = strtolower($file->getClientOriginalExtension());
            $name = str_pad((string)($i + 1), 3, '0', STR_PAD_LEFT) . "." . $ext;
            $moved = $file->move($workDir, $name);
            $inputPaths[] = $moved->getPathname();
        }

        $outAbs = storage_path("app/pdf/{$jobId}.pdf");
        if (!is_dir(dirname($outAbs))) mkdir(dirname($outAbs), 0775, true);

        $cmd = array_merge(['img2pdf'], $inputPaths, ['-o', $outAbs]);
        $process = new Process($cmd);
        $process->setTimeout(120);
        $process->run();

        if (!$process->isSuccessful()) {
            $err = $process->getErrorOutput() ?: $process->getOutput();
            $this->cleanupDir($workDir);
            return response()->json([
                'ok' => false,
                'error' => 'Convert failed',
                'detail' => mb_substr($err, 0, 2000),
            ], 500);
        }

        $this->cleanupDir($workDir);

        // ✅ ดาวน์โหลดด้วยชื่อไฟล์ตามต้นฉบับ
        return response()->download($outAbs, $downloadName);
    }

    private function cleanupDir(string $dir): void
    {
        if (!is_dir($dir)) return;
        foreach (glob($dir . '/*') ?: [] as $f) @unlink($f);
        @rmdir($dir);
    }
}
