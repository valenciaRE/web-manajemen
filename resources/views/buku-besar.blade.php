@extends('layouts.app')

@section('page-title','Buku Besar')
@section('page-subtitle','/ Home / Akuntansi / Laporan')

@section('content')
<div class="space-y-6">

  <!-- FILTER + ACTIONS -->
  <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
      <div>
        <label class="text-sm block mb-1">Tanggal Awal</label>
        <input id="from" type="date" class="w-full p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
      </div>
      <div>
        <label class="text-sm block mb-1">Tanggal Akhir</label>
        <input id="to" type="date" class="w-full p-2 rounded border dark:bg-gray-700 dark:border-gray-600">
      </div>

      <div class="flex gap-2">
        <button id="btnFilter" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Tampilkan</button>
        <button id="btnExport" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Export Excel</button>
        <button id="btnDetail" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded">Detail</button>
      </div>
    </div>
  </div>

  <!-- DASHBOARD: CHARTS -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="col-span-2 bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
      <h3 class="font-semibold mb-3">Total per Akun</h3>
      <canvas id="barChart" height="160"></canvas>
    </div>

    <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
      <h3 class="font-semibold mb-3">Distribusi Saldo</h3>
      <canvas id="pieChart" height="200"></canvas>
    </div>
  </div>

  <!-- TABLE + SEARCH -->
  <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-md">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-3 gap-3">
      <div>
        <h4 class="font-semibold">Buku Besar | Tanggal Awal: - , Tanggal Akhir: -</h4>
        <p class="text-sm text-gray-500 dark:text-gray-400">Klik nama akun untuk lihat detail transaksi.</p>
      </div>

      <div class="flex items-center gap-3">
        <input id="search" type="text" placeholder="Cari akun..." class="px-3 py-2 rounded border dark:bg-gray-700 dark:border-gray-600">
        <select id="perPage" class="px-3 py-2 rounded border dark:bg-gray-700 dark:border-gray-600">
          <option value="5">5 / halaman</option>
          <option value="10" selected>10 / halaman</option>
          <option value="25">25 / halaman</option>
        </select>
      </div>
    </div>

    <div class="overflow-x-auto scroll-shadow">
      <table id="ledgerTable" class="w-full table-fixed text-sm">
        <thead>
          <tr class="bg-gray-100 dark:bg-gray-700">
            <th class="p-3 border cursor-pointer" data-key="account">Akun</th>
            <th class="p-3 border cursor-pointer" data-key="opening">Saldo Awal</th>
            <th class="p-3 border cursor-pointer" data-key="debit">Debit</th>
            <th class="p-3 border cursor-pointer" data-key="credit">Kredit</th>
            <th class="p-3 border cursor-pointer" data-key="ending">Saldo Akhir</th>
          </tr>
        </thead>
        <tbody id="tbody" class="divide-y"></tbody>
      </table>
    </div>

    <!-- pagination -->
    <div class="flex items-center justify-between mt-4">
      <div class="text-sm text-gray-500" id="pagerInfo"></div>
      <div class="flex gap-2">
        <button id="prevBtn" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">Prev</button>
        <button id="nextBtn" class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">Next</button>
      </div>
    </div>
  </div>

</div>

<!-- Accordion template modal-like details are inline below rows -->
<script>
  // ===== demo DATA =====
  // In production, fill rows from server via Blade or fetch JSON.
  const DATA = [
    {
      id:1, account:'1.0.00 - Aset', opening:0, debit:0, credit:0, ending:0,
      transactions: []
    },
    {
      id:2, account:'1.1.01 - Kas Besar', opening:17666589600, debit:0, credit:0, ending:17666589600,
      transactions: [
        {date:'2025-01-01', desc:'Setoran', debit:1000000, credit:0},
        {date:'2025-02-05', desc:'Pengeluaran', debit:0, credit:500000},
      ]
    },
    {
      id:3, account:'1.1.01.02 - Kas Kecil', opening:-34750, debit:0, credit:0, ending:-34750,
      transactions: [{date:'2025-03-03', desc:'Beli ATK', debit:0, credit:34750}]
    }
    // ... tambahkan data sesuai kebutuhan
  ];

  // ===== utilities =====
  function fmt(n){
    // format number to Indonesian money style
    const neg = n < 0;
    const a = Math.abs(Math.round(n));
    return (neg ? '(' : '') + a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".") + (neg ? ')' : '');
  }

  // ===== table logic =====
  let state = {
    q: '', page:1, perPage:10, sortKey:null, sortDir: 'asc', rows: DATA.slice()
  };

  const tbody = document.getElementById('tbody');
  const searchEl = document.getElementById('search');
  const perPageEl = document.getElementById('perPage');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const pagerInfo = document.getElementById('pagerInfo');

  function filterAndSort(){
    let rows = DATA.filter(r => r.account.toLowerCase().includes(state.q.toLowerCase()));
    if(state.sortKey){
      rows.sort((a,b)=>{
        let A = a[state.sortKey], B = b[state.sortKey];
        A = (typeof A === 'string') ? A.toLowerCase() : A;
        B = (typeof B === 'string') ? B.toLowerCase() : B;
        return state.sortDir==='asc' ? (A>B?1:-1) : (A>B?-1:1);
      });
    }
    state.rows = rows;
  }

  function renderTable(){
    filterAndSort();
    const total = state.rows.length;
    const per = Number(state.perPage);
    const pages = Math.max(1, Math.ceil(total/per));
    if(state.page > pages) state.page = pages;

    const start = (state.page-1)*per;
    const pageRows = state.rows.slice(start, start+per);

    // build rows + accordion details
    tbody.innerHTML = pageRows.map(r => `
      <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
        <td class="p-3 border align-top">
          <button onclick="toggleAccordion(${r.id})" class="font-medium text-left">${r.account}</button>
        </td>
        <td class="p-3 border align-top text-right">${fmt(r.opening)}</td>
        <td class="p-3 border align-top text-right">${fmt(r.debit)}</td>
        <td class="p-3 border align-top text-right">${fmt(r.credit)}</td>
        <td class="p-3 border align-top text-right">${fmt(r.ending)}</td>
      </tr>
      <tr id="acc-${r.id}" class="accordion-row hidden bg-gray-50 dark:bg-gray-800">
        <td colspan="5" class="p-4 border">
          ${ renderTransactions(r.transactions) }
        </td>
      </tr>
    `).join('');

    pagerInfo.innerText = `Menampilkan ${start+1} - ${Math.min(start+per, total)} dari ${total} akun`;
    prevBtn.disabled = state.page <= 1;
    nextBtn.disabled = state.page >= pages;
  }

  function renderTransactions(tx){
    if(!tx || tx.length===0) return '<div class="text-sm text-gray-500">Tidak ada transaksi.</div>';
    return `
      <div class="space-y-2">
        ${tx.map(t => `
          <div class="flex justify-between text-sm">
            <div class="w-1/3">${t.date}</div>
            <div class="w-1/3">${t.desc}</div>
            <div class="w-1/3 text-right">${fmt(t.debit)} / ${fmt(t.credit)}</div>
          </div>
        `).join('')}
      </div>
    `;
  }

  function toggleAccordion(id){
    const el = document.getElementById('acc-' + id);
    if(!el) return;
    el.classList.toggle('hidden');
  }

  // search/sort/paginate handlers
  searchEl.addEventListener('input', e => { state.q = e.target.value; state.page = 1; renderTable(); });
  perPageEl.addEventListener('change', e => { state.perPage = e.target.value; state.page = 1; renderTable(); });
  prevBtn.addEventListener('click', ()=> { state.page--; renderTable(); });
  nextBtn.addEventListener('click', ()=> { state.page++; renderTable(); });

  // header sorting
  document.querySelectorAll('#ledgerTable thead th').forEach(th=>{
    th.addEventListener('click', ()=>{
      const key = th.getAttribute('data-key');
      if(!key) return;
      if(state.sortKey===key) state.sortDir = state.sortDir==='asc' ? 'desc' : 'asc';
      else { state.sortKey = key; state.sortDir = 'asc'; }
      renderTable();
    });
  });

  // initial render
  renderTable();

  // ===== Charts (Chart.js) =====
  const labels = DATA.map(d => d.account);
  const openingData = DATA.map(d=>d.opening);
  const endingData = DATA.map(d=>d.ending);

  const barCtx = document.getElementById('barChart').getContext('2d');
  const barChart = new Chart(barCtx, {
    type:'bar',
    data:{
      labels: labels,
      datasets:[
        { label:'Saldo Awal', data: openingData, backgroundColor:'rgba(59,130,246,0.8)' },
        { label:'Saldo Akhir', data: endingData, backgroundColor:'rgba(16,185,129,0.8)' }
      ]
    },
    options:{
      responsive:true,
      maintainAspectRatio:false,
      interaction:{mode:'index', intersect:false},
      scales:{ x:{ ticks:{autoSkip:false, maxRotation:35, minRotation:0 }}, y:{ beginAtZero:true } }
    }
  });

  const pieCtx = document.getElementById('pieChart').getContext('2d');
  const pieChart = new Chart(pieCtx, {
    type:'pie',
    data:{
      labels: labels,
      datasets:[{ data: endingData.map(v=>Math.abs(v)), backgroundColor: labels.map((_,i)=>`hsl(${i*70 % 360} 70% 50%)`) }]
    },
    options:{ responsive:true, maintainAspectRatio:false }
  });

  // example filter button: update charts when filter clicked (demo)
  document.getElementById('btnFilter').addEventListener('click', ()=>{
    // in production, we'd fetch filtered data. here just re-render charts (demo)
    barChart.update(); pieChart.update(); renderTable();
  });

  // export (simple CSV export demo)
  document.getElementById('btnExport').addEventListener('click', ()=>{
    const rows = [['Akun','Saldo Awal','Debit','Kredit','Saldo Akhir']];
    DATA.forEach(r => rows.push([r.account, r.opening, r.debit, r.credit, r.ending]));
    const csv = rows.map(r => r.map(c=>`"${c}"`).join(',')).join('\n');
    const blob = new Blob([csv], {type:'text/csv'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a'); a.href = url; a.download = 'buku-besar.csv'; a.click();
    URL.revokeObjectURL(url);
  });

  // detail button (demo: expand all)
  document.getElementById('btnDetail').addEventListener('click', ()=>{
    document.querySelectorAll('.accordion-row').forEach(r => r.classList.remove('hidden'));
    setTimeout(()=>window.scrollTo({top: document.body.scrollHeight, behavior:'smooth'}), 200);
  });
</script>
@endsection
