<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Images → PDF</title>
  <style>
    :root{
      --bg:#0b1220;
      --card:#0f1a2f;
      --muted:#9fb0cc;
      --text:#eaf1ff;
      --line:rgba(255,255,255,.10);
      --accent:#4f8cff;
      --accent2:#6ee7b7;
      --danger:#ff5c7a;
      --shadow: 0 18px 60px rgba(0,0,0,.35);
      --radius: 18px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Noto Sans Thai", Arial;
      background: radial-gradient(900px 480px at 15% 20%, rgba(79,140,255,.25), transparent 55%),
                  radial-gradient(900px 480px at 85% 25%, rgba(110,231,183,.18), transparent 55%),
                  var(--bg);
      color:var(--text);
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:28px;
    }
    .wrap{width:100%; max-width:920px;}
    .header{
      display:flex; gap:14px; align-items:center; justify-content:space-between;
      margin-bottom:16px;
    }
    .title{
      display:flex; flex-direction:column; gap:6px;
    }
    .title h1{
      margin:0;
      font-size:26px;
      letter-spacing:.2px;
    }
    .title p{
      margin:0;
      color:var(--muted);
      font-size:14px;
    }
    .badge{
      padding:8px 12px;
      border:1px solid var(--line);
      border-radius:999px;
      color:var(--muted);
      font-size:12px;
      background:rgba(255,255,255,.03);
    }

    .card{
      background: linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.02));
      border:1px solid var(--line);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      overflow:hidden;
    }
    .card-body{padding:18px;}
    .row{
      display:grid;
      grid-template-columns: 1.1fr .9fr;
      gap:16px;
    }
    @media (max-width: 780px){
      .row{grid-template-columns:1fr;}
    }

    .drop{
      border:1px dashed rgba(255,255,255,.22);
      border-radius:16px;
      padding:18px;
      background:rgba(15,26,47,.55);
      transition:.15s ease;
      position:relative;
      min-height:170px;
      display:flex;
      align-items:center;
      justify-content:center;
      text-align:center;
    }
    .drop.dragover{
      border-color: rgba(79,140,255,.8);
      background: rgba(79,140,255,.10);
      transform: translateY(-1px);
    }
    .drop-inner{
      display:flex; flex-direction:column; align-items:center; gap:10px;
      max-width:420px;
    }
    .icon{
      width:44px; height:44px; border-radius:14px;
      display:grid; place-items:center;
      background: rgba(79,140,255,.14);
      border:1px solid rgba(79,140,255,.25);
    }
    .icon svg{opacity:.9}
    .drop h3{margin:0; font-size:16px}
    .drop p{margin:0; color:var(--muted); font-size:13px; line-height:1.5}
    .hint{color:var(--muted); font-size:12px}

    .actions{
      display:flex;
      gap:10px;
      flex-wrap:wrap;
      justify-content:center;
      margin-top:10px;
    }
    .btn{
      border:1px solid var(--line);
      background: rgba(255,255,255,.04);
      color:var(--text);
      border-radius:12px;
      padding:10px 14px;
      cursor:pointer;
      font-weight:600;
      font-size:14px;
      transition:.15s ease;
      display:inline-flex;
      align-items:center;
      gap:8px;
    }
    .btn:hover{transform: translateY(-1px); background: rgba(255,255,255,.06)}
    .btn-primary{
      border-color: rgba(79,140,255,.45);
      background: linear-gradient(180deg, rgba(79,140,255,.25), rgba(79,140,255,.14));
    }
    .btn-primary:hover{background: linear-gradient(180deg, rgba(79,140,255,.30), rgba(79,140,255,.16))}
    .btn:disabled{
      opacity:.55; cursor:not-allowed; transform:none;
    }
    input[type="file"]{display:none}

    .side{
      border:1px solid var(--line);
      border-radius:16px;
      padding:16px;
      background:rgba(15,26,47,.45);
      min-height:170px;
      display:flex;
      flex-direction:column;
      gap:10px;
    }
    .meta{
      display:flex; gap:10px; flex-wrap:wrap;
      color:var(--muted);
      font-size:13px;
    }
    .pill{
      padding:6px 10px;
      border:1px solid var(--line);
      border-radius:999px;
      background:rgba(255,255,255,.03);
    }
    .list{
      margin:0;
      padding:0;
      list-style:none;
      display:flex;
      flex-direction:column;
      gap:8px;
      max-height:220px;
      overflow:auto;
    }
    .item{
      padding:10px 12px;
      border:1px solid var(--line);
      border-radius:14px;
      background:rgba(255,255,255,.03);
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
    }
    .item small{color:var(--muted)}
    .footer{
      margin-top:12px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
      flex-wrap:wrap;
      color:var(--muted);
      font-size:12px;
      padding:12px 18px;
      border-top:1px solid var(--line);
      background:rgba(255,255,255,.02);
    }
    .alert{
      border:1px solid rgba(255,92,122,.45);
      background: rgba(255,92,122,.10);
      border-radius:14px;
      padding:12px 14px;
      color: #ffd2da;
      margin-bottom:14px;
    }
    .ok{
      border:1px solid rgba(110,231,183,.45);
      background: rgba(110,231,183,.10);
      color: #d8ffef;
    }
    .muted{color:var(--muted)}
  </style>
</head>

<body>
  <div class="wrap">
    <div class="header">
      <div class="title">
        <h1>Images → PDF</h1>
        <p>อัปโหลดรูป (JPG/PNG/TIFF) หลายไฟล์ แล้วกด Convert เพื่อดาวน์โหลด PDF ทันที</p>
      </div>
      <div class="badge">Synchronous • Docker</div>
    </div>

    @if ($errors->any())
      <div class="alert">
        <strong>ตรวจพบข้อผิดพลาด</strong>
        <ul style="margin:8px 0 0 18px;">
          @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card">
      <div class="card-body">
        <form id="form" method="POST" action="/img2pdf" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <!-- Drop zone -->
            <div>
              <div id="drop" class="drop">
                <div class="drop-inner">
                  <div class="icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                      <path d="M12 16V4m0 0 4 4m-4-4-4 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M4 16v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                  </div>
                  <h3>ลากไฟล์มาวาง หรือกดเลือกไฟล์</h3>
                  <p>รองรับ <b>JPG / PNG / TIFF</b> • รวมเป็น PDF หลายหน้า • เรียงตามลำดับที่เลือก</p>
                  <div class="actions">
                    <label class="btn" for="images">เลือกไฟล์</label>
                    <button type="button" class="btn" id="clearBtn">ล้างรายการ</button>
                  </div>
                  <div class="hint">Tip: ถ้าต้องการเรียงหน้าใหม่ ให้เลือกไฟล์ใหม่ตามลำดับที่ต้องการ</div>
                </div>
              </div>

              <input id="images" type="file" name="images[]" multiple accept=".jpg,.jpeg,.png,.tif,.tiff" required>
            </div>

            <!-- File list -->
            <div class="side">
              <div style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
                <div style="font-weight:700;">ไฟล์ที่เลือก</div>
                <span class="muted" id="statusText">ยังไม่ได้เลือกไฟล์</span>
              </div>

              <div class="meta">
                <span class="pill" id="countPill">0 ไฟล์</span>
                <span class="pill" id="sizePill">0 MB</span>
                <span class="pill">Max: 50 ไฟล์</span>
              </div>

              <ul id="fileList" class="list"></ul>

              <div style="margin-top:auto; display:flex; gap:10px; flex-wrap:wrap;">
                <button id="convertBtn" class="btn btn-primary" type="submit" disabled>
                  <span id="btnText">Convert → PDF</span>
              </div>

              <div class="muted" style="font-size:12px; line-height:1.45;">
                • ถ้าไฟล์ใหญ่/หลายไฟล์ อาจใช้เวลาเล็กน้อย<br>
                • ถ้าต้องการให้ค้นหาได้ (OCR) บอกได้ เดี๋ยวต่อให้
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="footer">
        <div>รองรับ: JPG / PNG / TIFF • รวมเป็น PDF ทันที</div>
        <div>Security: ตรวจชนิดไฟล์ + จำกัดขนาดตาม validation</div>
      </div>
    </div>
  </div>

  <script>
    const input = document.getElementById('images');
    const drop = document.getElementById('drop');
    const list = document.getElementById('fileList');
    const convertBtn = document.getElementById('convertBtn');
    const clearBtn = document.getElementById('clearBtn');
    const statusText = document.getElementById('statusText');
    const countPill = document.getElementById('countPill');
    const sizePill = document.getElementById('sizePill');
    const btnText = document.getElementById('btnText');
    const form = document.getElementById('form');

    function fmtSize(bytes){
      const mb = bytes / (1024*1024);
      return mb.toFixed(mb >= 10 ? 0 : 1) + " MB";
    }

    function renderFiles(){
      list.innerHTML = '';
      const files = input.files ? Array.from(input.files) : [];
      let total = 0;

      files.forEach((f, idx) => {
        total += f.size;
        const li = document.createElement('li');
        li.className = 'item';
        li.innerHTML = `
          <div style="min-width:0">
            <div style="font-weight:650; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
              ${idx+1}. ${f.name}
            </div>
            <small>${fmtSize(f.size)}</small>
          </div>
          <small>${(f.type || 'image/*').replace('image/', '').toUpperCase()}</small>
        `;
        list.appendChild(li);
      });

      countPill.textContent = `${files.length} ไฟล์`;
      sizePill.textContent = fmtSize(total);

      if(files.length === 0){
        statusText.textContent = 'ยังไม่ได้เลือกไฟล์';
        convertBtn.disabled = true;
      }else{
        statusText.textContent = 'พร้อมแปลง';
        convertBtn.disabled = false;
      }
    }

    // Drag & drop behavior
    ;['dragenter','dragover'].forEach(evt => {
      drop.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        drop.classList.add('dragover');
      });
    });
    ;['dragleave','drop'].forEach(evt => {
      drop.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        drop.classList.remove('dragover');
      });
    });

    drop.addEventListener('drop', (e) => {
      const dt = e.dataTransfer;
      if(!dt || !dt.files || dt.files.length === 0) return;

      // ตั้งค่า input.files ด้วย DataTransfer ใหม่
      const allow = ['image/jpeg','image/png','image/tiff'];
      const files = Array.from(dt.files).filter(f => {
        // บาง browser ไม่ส่ง type สำหรับ tiff บางกรณี => เช็กจากนามสกุลด้วย
        const name = (f.name || '').toLowerCase();
        const extOk = name.endsWith('.jpg') || name.endsWith('.jpeg') || name.endsWith('.png') || name.endsWith('.tif') || name.endsWith('.tiff');
        return allow.includes(f.type) || extOk;
      });

      const transfer = new DataTransfer();
      files.forEach(f => transfer.items.add(f));
      input.files = transfer.files;

      renderFiles();
    });

    input.addEventListener('change', renderFiles);

    clearBtn.addEventListener('click', () => {
      input.value = '';
      renderFiles();
    });

    // UX: disable button + show loading on submit
    form.addEventListener('submit', () => {
      convertBtn.disabled = true;
      btnText.textContent = 'กำลังแปลง...';
    });

    renderFiles();
  </script>
</body>
</html>
