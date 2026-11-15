<style>
  .bop-container {
    --border:#e2e5ea;
    --bg-soft:#f7f8fa;
    --text-main:#1f2430;
    --text-sub:#7a8194;
    --blue:#2f6fed;
    --dark:#1c2333;
    color: var(--text-main);
  }
  .bop-container * { box-sizing:border-box; }
  
  .bop-container .box{
    border:1px solid var(--border);
    border-radius:10px;
    padding:20px 24px 28px;
    background: #fff;
  }
  .bop-container .box-title{
    font-size:15px;
    font-weight:600;
    margin:0 0 18px;
  }
  .bop-container .stage-select-wrap{ max-width:280px; margin:0 0 24px; }
  .bop-container .stage-row{ display:flex; align-items:flex-end; gap:14px; margin-bottom:24px; flex-wrap:wrap; }
  .bop-container .stage-select-wrap label{ display:block; font-size:12px; color:var(--text-sub); margin-bottom:6px; }
  .bop-container .stage-select{
    width:100%; font-size:14px; font-weight:600; color:var(--blue); padding:10px 36px 10px 14px;
    border:1px solid var(--border); border-radius:8px;
    background:#fff url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6"><path d="M1 1l4 4 4-4" stroke="%237a8194" stroke-width="1.6" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>') no-repeat right 14px center;
    appearance:none; -webkit-appearance:none; cursor:pointer;
  }
  .bop-container .add-stage-btn{
    display:flex; align-items:center; gap:6px; padding:10px 16px; border:1px dashed var(--blue); border-radius:8px;
    color:var(--blue); font-size:13px; font-weight:600; cursor:pointer; background:#eef3ff; white-space:nowrap;
  }
  .bop-container .info-grid{ display:grid; grid-template-columns:1fr 1fr; gap:16px 40px; margin-bottom:24px; }
  .bop-container .field label{ display:block; font-size:12px; color:var(--text-sub); margin-bottom:6px; }
  .bop-container .field .readonly-value{
    font-size:14px; color:var(--text-main); padding:10px 12px; background:var(--bg-soft); border:1px solid var(--border); border-radius:8px;
  }
  .bop-container .field input[type="text"], .bop-container .field input[type="number"], .bop-container .field input[type="date"]{
    width:100%; font-size:14px; padding:10px 12px; border:1px solid var(--border); border-radius:8px; color:var(--text-main); background:#fff;
  }
  .bop-container .field input::placeholder{color:#b7bcc7;}
  .bop-container .field-full{ margin-top:16px; }
  .bop-container .field textarea{
    width:100%; font-size:14px; padding:10px 12px; border:1px solid var(--border); border-radius:8px; color:var(--text-main); background:#fff; resize:vertical; min-height:72px; font-family:inherit;
  }
  .bop-container .field textarea::placeholder{color:#b7bcc7;}
  .bop-container .form-section{
    background:var(--bg-soft); border-radius:10px; padding:20px 20px 24px; margin-bottom:22px;
  }
  .bop-container .progress-wrap{ margin-top:6px; }
  .bop-container .progress-top{ display:flex; justify-content:space-between; font-size:13px; margin-bottom:8px; }
  .bop-container .progress-top .pct{font-weight:700;font-size:15px;}
  .bop-container .progress-range{
    -webkit-appearance:none; appearance:none; width:100%; height:4px; border-radius:2px; background:var(--border); outline:none; margin:0;
  }
  .bop-container .progress-range::-webkit-slider-thumb{
    -webkit-appearance:none; width:16px;height:16px;border-radius:50%; background:var(--blue); border:3px solid #fff; box-shadow:0 0 0 1px var(--blue); cursor:pointer;
  }
  .bop-container .progress-labels{ display:flex;justify-content:space-between; font-size:12px;color:var(--text-sub); margin-top:8px; }
  .bop-container .detail-header-row{ display:flex; justify-content:space-between; align-items:center; margin:30px 0 14px; flex-wrap:wrap; gap:12px; }
  .bop-container .detail-title{ font-size:15px; font-weight:600; margin:0; }
  .bop-container .btn-add-payment{ background:var(--blue); color:#fff; border-color:var(--blue); padding:9px 18px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; border:1px solid; }
  .bop-container .detail-table-wrap{ border:1px solid var(--border); border-radius:10px; overflow:hidden; }
  .bop-container table.detail-table{ width:100%; border-collapse:collapse; font-size:13px; }
  .bop-container table.detail-table th{
    background:var(--bg-soft); color:var(--text-sub); font-weight:600; font-size:12px; text-align:left; padding:12px 16px; white-space:nowrap;
  }
  .bop-container table.detail-table th.num, .bop-container table.detail-table td.num{ text-align:right; }
  .bop-container table.detail-table td{ padding:11px 16px; border-top:1px solid var(--border); color:var(--text-main); }
  .bop-container table.detail-table td.paid{ color:var(--blue); font-weight:600; }
  .bop-container table.detail-table td.remove{ color:#e14b4b; text-align:center; cursor:pointer; font-weight: bold;}
  .bop-container .grand-total-bar{
    display:flex; justify-content:space-between; align-items:center; background:var(--dark); color:#fff; padding:14px 20px; font-weight:600; font-size:14px;
  }
</style>

<div class="bop-container">
  <div class="box">
    <div class="stage-row">
      <div class="stage-select-wrap">
        <label>Termin Pembayaran</label>
        <select class="stage-select" id="stageSelect">
          <option value="Termin 1 (DP)">Termin 1 (DP)</option>
          <option value="Termin 2">Termin 2</option>
          <option value="Termin 3">Termin 3</option>
        </select>
      </div>
      <div class="add-stage-btn" id="addStageBtn">+ Tambah Termin</div>
    </div>

    <div class="info-grid" style="grid-template-columns:1fr; max-width:280px;">
      <div class="field">
        <label>Nilai Kontrak</label>
        <div class="readonly-value">Rp {{ number_format($project->contract_value ?? 0, 0, ',', '.') }}</div>
      </div>
    </div>

    <div class="form-section">
      <div class="info-grid" style="margin-bottom:0;">
        <div class="field">
          <label>No. Invoice</label>
          <input type="text" id="invoiceInput" placeholder="mis. INV/2026/001">
        </div>
        <div class="field">
          <label>Nilai Bayar</label>
          <input type="text" id="nilaiInput" placeholder="0" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class="field">
          <label>Tanggal Bayar</label>
          <input type="date" id="tanggalInput">
        </div>
        <div class="field">
          <label>Persentase Progres (%)</label>
          <div class="progress-wrap">
            <div class="progress-top">
              <span class="pct" id="progressPct">0%</span>
            </div>
            <input type="range" id="progressRange" class="progress-range" min="0" max="100" value="0">
            <div class="progress-labels">
              <span>0</span><span>100%</span>
            </div>
          </div>
        </div>
      </div>
      <div class="field field-full">
        <label>Deskripsi</label>
        <textarea id="deskripsiInput" placeholder="mis. Pembayaran termin 1 sesuai kontrak, transfer via BCA"></textarea>
      </div>
    </div>

    <div class="detail-header-row">
      <p class="detail-title">Detail Hasil Pembayaran</p>
      <div class="btn-add-payment" id="addPaymentBtn">+ Tambah Pembayaran</div>
    </div>
    <div class="detail-table-wrap">
      <table class="detail-table" id="paymentTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Termin</th>
            <th>No. Invoice</th>
            <th>Tanggal Bayar</th>
            <th class="num">Nilai Bayar (Rp)</th>
            <th class="num">Progres (%)</th>
            <th>Status</th>
            <th>Deskripsi</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="paymentTableBody">
          <!-- Rows will be populated by JS -->
        </tbody>
      </table>
      <div class="grand-total-bar">
        <span>Grand total terbayar (Rp)</span>
        <span id="grandTotal">0</span>
      </div>
    </div>
    
    <!-- Hidden inputs will be generated here for form submission -->
    <div id="bopHiddenInputs"></div>

    <!-- Overall progress hidden input -->
    <input type="hidden" name="prog_bill_of_payment" id="overallBopProgress" value="{{ $project->prog_bill_of_payment ?? 0 }}">
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const stageSelect = document.getElementById('stageSelect');
  const addStageBtn = document.getElementById('addStageBtn');
  const addPaymentBtn = document.getElementById('addPaymentBtn');
  const tableBody = document.getElementById('paymentTableBody');
  const invoiceInput = document.getElementById('invoiceInput');
  const nilaiInput = document.getElementById('nilaiInput');
  const tanggalInput = document.getElementById('tanggalInput');
  const progressRange = document.getElementById('progressRange');
  const progressPct = document.getElementById('progressPct');
  const deskripsiInput = document.getElementById('deskripsiInput');
  const grandTotalEl = document.getElementById('grandTotal');
  const hiddenInputsContainer = document.getElementById('bopHiddenInputs');

  let paymentRecords = [];

  // Initialize with existing data from server
  const existingBops = @json($project->billOfPayments ?? []);
  
  existingBops.forEach(bop => {
      let d = new Date(bop.due_payment);
      let dateFormatted = bop.due_payment ? d.toISOString().split('T')[0] : '';
      let terminKey = bop.payment_name.replace(/ /g, '_');
      
      // Ensure the dropdown has this stage
      let optionExists = Array.from(stageSelect.options).some(opt => opt.value === bop.payment_name);
      if(!optionExists) {
          const opt = document.createElement('option');
          opt.value = bop.payment_name;
          opt.textContent = bop.payment_name;
          stageSelect.appendChild(opt);
      }
      
      paymentRecords.push({
          termin: bop.payment_name,
          invoice: bop.invoice_no || '—',
          nilai: parseFloat(bop.total) || 0,
          tanggal: dateFormatted,
          progress: parseFloat(bop.percentage) || 0,
          status: bop.status || 'Unpaid',
          deskripsi: bop.description || '—'
      });
  });

  renderTable();

  progressRange.addEventListener('input', () => {
    progressPct.textContent = progressRange.value + '%';
  });

  function formatRupiah(num){
    return parseInt(num).toLocaleString('id-ID');
  }

  function parseDateForDisplay(isoDate){
    if(!isoDate) return '—';
    const parts = isoDate.split('-');
    if(parts.length === 3) {
        return parts[2] + '/' + parts[1] + '/' + parts[0];
    }
    return isoDate;
  }

  function renderTable() {
    tableBody.innerHTML = '';
    hiddenInputsContainer.innerHTML = '';
    let grandTotal = 0;
    let maxProgress = 0;

    paymentRecords.forEach((record, index) => {
        grandTotal += record.nilai;
        let currentProg = parseFloat(record.progress) || 0;
        if(currentProg > maxProgress) {
            maxProgress = currentProg;
        }
        
        // Add to Table
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${index + 1}</td>
          <td>${record.termin}</td>
          <td>${record.invoice}</td>
          <td>${parseDateForDisplay(record.tanggal)}</td>
          <td class="num">${formatRupiah(record.nilai)}</td>
          <td class="num">${record.progress}</td>
          <td class="${record.status === 'Paid' ? 'paid' : ''}">${record.status}</td>
          <td>${record.deskripsi}</td>
          <td class="remove" data-index="${index}">✕</td>
        `;
        tableBody.appendChild(row);

        // Add hidden inputs for submission
        let key = record.termin.replace(/ /g, '_'); // Using underscore to avoid array key issues in PHP
        
        let html = `
            <input type="hidden" name="bop[${key}][payment_name]" value="${record.termin}">
            <input type="hidden" name="bop[${key}][invoice_no]" value="${record.invoice !== '—' ? record.invoice : ''}">
            <input type="hidden" name="bop[${key}][total]" value="${record.nilai}">
            <input type="hidden" name="bop[${key}][due_payment]" value="${record.tanggal !== '—' ? record.tanggal : ''}">
            <input type="hidden" name="bop[${key}][percentage]" value="${record.progress}">
            <input type="hidden" name="bop[${key}][status]" value="${record.status}">
            <input type="hidden" name="bop[${key}][description]" value="${record.deskripsi !== '—' ? record.deskripsi : ''}">
        `;
        hiddenInputsContainer.insertAdjacentHTML('beforeend', html);
    });

    grandTotalEl.textContent = formatRupiah(grandTotal);
    
    // Update the overall project payment progress
    const overallProgressEl = document.getElementById('overallBopProgress');
    if (overallProgressEl) {
        overallProgressEl.value = maxProgress;
    }

    // Bind remove buttons
    document.querySelectorAll('#paymentTableBody .remove').forEach(btn => {
        btn.addEventListener('click', function() {
            const idx = this.getAttribute('data-index');
            paymentRecords.splice(idx, 1);
            renderTable();
        });
    });
  }

  addStageBtn.addEventListener('click', () => {
    const nextNum = stageSelect.options.length + 1;
    const opt = document.createElement('option');
    opt.value = 'Termin ' + nextNum;
    opt.textContent = 'Termin ' + nextNum;
    stageSelect.appendChild(opt);
    stageSelect.selectedIndex = stageSelect.options.length - 1;
  });

  addPaymentBtn.addEventListener('click', () => {
    const termin = stageSelect.value;
    const invoice = invoiceInput.value.trim() || '—';
    const nilai = parseInt(nilaiInput.value) || 0;
    const tanggal = tanggalInput.value || '';
    const progress = progressRange.value;
    const deskripsi = deskripsiInput.value.trim() || '—';
    const status = nilai > 0 ? (progress >= 100 ? 'Paid' : 'Partial') : 'Unpaid';
    
    // Check if termin already exists, if so update it, else push new
    const existingIndex = paymentRecords.findIndex(r => r.termin === termin);
    if(existingIndex >= 0) {
        paymentRecords[existingIndex] = {
            termin, invoice, nilai, tanggal, progress, status, deskripsi
        };
    } else {
        paymentRecords.push({
            termin, invoice, nilai, tanggal, progress, status, deskripsi
        });
    }

    renderTable();

    // Reset Form
    invoiceInput.value = '';
    nilaiInput.value = '';
    tanggalInput.value = '';
    progressRange.value = 0;
    progressPct.textContent = '0%';
    deskripsiInput.value = '';
  });
});
</script>
