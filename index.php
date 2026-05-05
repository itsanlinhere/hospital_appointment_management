<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MediCare HMS – Hospital Management</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
  --cream: #fdf8f3;
  --warm-white: #fff9f4;
  --sage: #7a9e87;
  --sage-light: #a8c5b0;
  --sage-dark: #4f7a62;
  --blush: #e8b4a0;
  --blush-light: #f5d5c8;
  --clay: #c97b5a;
  --deep: #2d3a35;
  --mid: #4a5c52;
  --muted: #8a9e94;
  --border: rgba(122,158,135,0.2);
  --border-warm: rgba(201,123,90,0.2);
  --card: rgba(255,252,248,0.9);
  --shadow: rgba(45,58,53,0.08);
  --danger: #c0392b;
  --danger-light: rgba(192,57,43,0.1);
}

* { margin:0; padding:0; box-sizing:border-box; }

body {
  font-family: 'Nunito', sans-serif;
  background: var(--cream);
  color: var(--deep);
  min-height: 100vh;
  overflow-x: hidden;
}
/* Stage select fix */
.stage-opt {
  display: flex !important;
  align-items: center;
  justify-content: center;
  padding: 9px 6px;
  border-radius: 10px;
  border: 1.5px solid var(--border);
  background: rgba(255,255,255,0.5);
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--mid);
  cursor: pointer;
  text-align: center;
  transition: all 0.2s;
  user-select: none;
}

.stage-select-group {
  display: grid !important;
  grid-template-columns: repeat(5, 1fr);
  gap: 8px;
}
/* ── BACKGROUND ── */
body::before {
  content:'';
  position:fixed;
  inset:0;
  background:
    radial-gradient(ellipse 600px 400px at 10% 20%, rgba(168,197,176,0.18) 0%, transparent 70%),
    radial-gradient(ellipse 500px 600px at 90% 80%, rgba(232,180,160,0.15) 0%, transparent 70%),
    radial-gradient(ellipse 400px 300px at 50% 50%, rgba(255,249,244,0.5) 0%, transparent 80%);
  pointer-events:none;
  z-index:0;
}

/* subtle linen texture */
body::after {
  content:'';
  position:fixed;
  inset:0;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  pointer-events:none;
  z-index:0;
  opacity:0.6;
}

/* ── SIDEBAR ── */
.sidebar {
  position:fixed;
  left:0; top:0; bottom:0;
  width:260px;
  background: linear-gradient(170deg, #2d3a35 0%, #1e2820 100%);
  z-index:100;
  display:flex;
  flex-direction:column;
  border-right:1px solid rgba(255,255,255,0.06);
  box-shadow:4px 0 30px rgba(0,0,0,0.15);
}

/* ── LOGO BLOCK ── */
.logo-block {
  padding: 32px 24px 24px;
  border-bottom:1px solid rgba(255,255,255,0.08);
}

.logo-top {
  display:flex;
  align-items:center;
  gap:14px;
  margin-bottom:18px;
}

.logo-icon {
  width:52px; height:52px;
  background: linear-gradient(135deg, var(--sage), var(--sage-dark));
  border-radius:16px;
  display:flex; align-items:center; justify-content:center;
  font-size:24px;
  box-shadow:0 4px 20px rgba(79,122,98,0.4);
  flex-shrink:0;
}

.logo-name {
  font-family:'Playfair Display', serif;
  font-size:1.25rem;
  font-weight:700;
  color:#fff;
  line-height:1.1;
}

.logo-tag {
  font-size:0.65rem;
  color:var(--sage-light);
  text-transform:uppercase;
  letter-spacing:2px;
  margin-top:3px;
}

/* Hospital Address Card */
.address-card {
  background:rgba(255,255,255,0.05);
  border:1px solid rgba(255,255,255,0.08);
  border-radius:12px;
  padding:14px 16px;
}

.address-line {
  display:flex;
  align-items:flex-start;
  gap:8px;
  font-size:0.78rem;
  color:rgba(255,255,255,0.55);
  line-height:1.5;
  margin-bottom:6px;
}

.address-line:last-child { margin-bottom:0; }
.address-line .ico { font-size:0.85rem; margin-top:1px; flex-shrink:0; }
.address-line strong { color:rgba(255,255,255,0.8); font-weight:600; }

/* ── NAV MENU ── */
.nav-menu {
  flex:1;
  padding:24px 16px;
  display:flex;
  flex-direction:column;
  gap:4px;
}

.nav-label {
  font-size:0.62rem;
  text-transform:uppercase;
  letter-spacing:2px;
  color:rgba(255,255,255,0.25);
  padding:4px 10px 10px;
  margin-top:8px;
}

.nav-btn {
  display:flex;
  align-items:center;
  gap:12px;
  padding:11px 14px;
  border:none;
  border-radius:10px;
  background:transparent;
  color:rgba(255,255,255,0.55);
  font-family:'Nunito', sans-serif;
  font-size:0.88rem;
  font-weight:600;
  cursor:pointer;
  transition:all 0.2s ease;
  text-align:left;
  width:100%;
}

.nav-btn:hover { background:rgba(255,255,255,0.07); color:rgba(255,255,255,0.85); }

.nav-btn.active {
  background: linear-gradient(135deg, rgba(122,158,135,0.3), rgba(79,122,98,0.2));
  color:#fff;
  border:1px solid rgba(122,158,135,0.3);
}

.nav-btn .nav-ico {
  width:32px; height:32px;
  border-radius:8px;
  background:rgba(255,255,255,0.07);
  display:flex; align-items:center; justify-content:center;
  font-size:0.9rem;
  flex-shrink:0;
  transition:background 0.2s;
}

.nav-btn.active .nav-ico { background:rgba(122,158,135,0.35); }

/* Sidebar footer */
.sidebar-footer {
  padding:16px 20px;
  border-top:1px solid rgba(255,255,255,0.08);
  font-size:0.72rem;
  color:rgba(255,255,255,0.25);
  text-align:center;
}

/* ── MAIN AREA ── */
.main-wrap {
  margin-left:260px;
  min-height:100vh;
  position:relative;
  z-index:1;
}

/* Top Bar */
.topbar {
  background:rgba(253,248,243,0.85);
  backdrop-filter:blur(20px);
  border-bottom:1px solid var(--border);
  padding:18px 36px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  position:sticky;
  top:0;
  z-index:50;
}

.topbar-title {
  font-family:'Playfair Display', serif;
  font-size:1.2rem;
  font-weight:600;
  color:var(--deep);
}

.topbar-meta {
  font-size:0.78rem;
  color:var(--muted);
  margin-top:1px;
}

.topbar-right {
  display:flex;
  align-items:center;
  gap:16px;
}

.status-pill {
  display:flex;
  align-items:center;
  gap:7px;
  background:rgba(122,158,135,0.12);
  border:1px solid rgba(122,158,135,0.25);
  padding:6px 14px;
  border-radius:99px;
  font-size:0.78rem;
  color:var(--sage-dark);
  font-weight:600;
}

.status-dot {
  width:7px; height:7px;
  border-radius:50%;
  background:var(--sage);
  animation:pulse 2s infinite;
}

@keyframes pulse {
  0%,100%{opacity:1;transform:scale(1);}
  50%{opacity:0.5;transform:scale(1.3);}
}

/* ── CONTENT ── */
.content {
  padding:36px;
}

/* ── SECTION ── */
.section { display:none; animation:fadeIn 0.35s ease; }
.section.active { display:block; }

@keyframes fadeIn {
  from{opacity:0;transform:translateY(12px);}
  to{opacity:1;transform:translateY(0);}
}

/* ── PAGE HEADER ── */
.page-header {
  margin-bottom:30px;
}

.page-title {
  font-family:'Playfair Display', serif;
  font-size:1.9rem;
  font-weight:700;
  color:var(--deep);
  margin-bottom:4px;
}

.page-sub {
  font-size:0.88rem;
  color:var(--muted);
  font-weight:400;
}

/* ── STATS CARDS ── */
.stats-row {
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:18px;
  margin-bottom:30px;
}

.stat-card {
  background:var(--card);
  border:1px solid var(--border);
  border-radius:16px;
  padding:22px 24px;
  display:flex;
  align-items:center;
  gap:18px;
  box-shadow:0 2px 20px var(--shadow);
  transition:transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover { transform:translateY(-3px); box-shadow:0 8px 30px var(--shadow); }

.stat-icon {
  width:50px; height:50px;
  border-radius:14px;
  display:flex; align-items:center; justify-content:center;
  font-size:1.4rem;
  flex-shrink:0;
}

.stat-icon.green { background:rgba(122,158,135,0.15); }
.stat-icon.blush { background:rgba(232,180,160,0.2); }
.stat-icon.clay  { background:rgba(201,123,90,0.12); }

.stat-num {
  font-family:'Playfair Display', serif;
  font-size:2rem;
  font-weight:700;
  color:var(--deep);
  line-height:1;
}

.stat-label {
  font-size:0.75rem;
  color:var(--muted);
  text-transform:uppercase;
  letter-spacing:1px;
  margin-top:3px;
  font-weight:600;
}

/* ── FORM CARD ── */
.form-card {
  background:var(--card);
  border:1px solid var(--border);
  border-radius:20px;
  padding:36px;
  box-shadow:0 4px 30px var(--shadow);
  backdrop-filter:blur(20px);
}

.form-section-label {
  font-size:0.7rem;
  text-transform:uppercase;
  letter-spacing:2px;
  color:var(--sage-dark);
  font-weight:700;
  margin-bottom:16px;
  display:flex;
  align-items:center;
  gap:8px;
}

.form-section-label::after {
  content:'';
  flex:1;
  height:1px;
  background:var(--border);
}

.form-grid {
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:20px;
  margin-bottom:24px;
}

.form-group {
  display:flex;
  flex-direction:column;
  gap:7px;
}

.form-group.full { grid-column:1/-1; }

label {
  font-size:0.75rem;
  text-transform:uppercase;
  letter-spacing:1.2px;
  color:var(--mid);
  font-weight:700;
}

input[type=text],input[type=number],input[type=date],select,textarea {
  background:rgba(255,255,255,0.7);
  border:1.5px solid var(--border);
  border-radius:10px;
  color:var(--deep);
  font-family:'Nunito', sans-serif;
  font-size:0.93rem;
  padding:11px 15px;
  outline:none;
  transition:all 0.2s;
  width:100%;
  appearance:none;
}

input:focus, select:focus, textarea:focus {
  border-color:var(--sage);
  background:#fff;
  box-shadow:0 0 0 3px rgba(122,158,135,0.15);
}

select option { background:#fff; color:var(--deep); }

.gender-group { display:flex; gap:10px; }

.gender-pill {
  flex:1;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:8px;
  padding:11px;
  border:1.5px solid var(--border);
  border-radius:10px;
  cursor:pointer;
  transition:all 0.2s;
  font-size:0.9rem;
  background:rgba(255,255,255,0.5);
  font-family:'Nunito',sans-serif;
  font-weight:600;
  color:var(--mid);
}

.gender-pill input[type=radio] { display:none; }
.gender-pill:has(input:checked) {
  border-color:var(--sage);
  background:rgba(122,158,135,0.12);
  color:var(--sage-dark);
}

/* Progress stages for admission */
.progress-stages {
  display:flex;
  align-items:center;
  gap:0;
  margin-bottom:28px;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:14px;
  padding:18px 24px;
  box-shadow:0 2px 12px var(--shadow);
}

.stage {
  flex:1;
  display:flex;
  flex-direction:column;
  align-items:center;
  gap:6px;
  position:relative;
}

.stage:not(:last-child)::after {
  content:'';
  position:absolute;
  right:0;
  top:15px;
  width:calc(50% + 1px);
  height:2px;
  background:var(--border);
  z-index:0;
}

.stage:not(:first-child)::before {
  content:'';
  position:absolute;
  left:0;
  top:15px;
  width:calc(50% - 1px);
  height:2px;
  background:var(--border);
  z-index:0;
}

.stage.done:not(:last-child)::after,
.stage.done:not(:first-child)::before,
.stage.active:not(:first-child)::before {
  background:var(--sage);
}

.stage-circle {
  width:30px; height:30px;
  border-radius:50%;
  background:#eee;
  border:2px solid var(--border);
  display:flex; align-items:center; justify-content:center;
  font-size:0.75rem;
  color:var(--muted);
  position:relative;
  z-index:1;
  transition:all 0.3s;
  font-weight:700;
}

.stage.done .stage-circle {
  background:var(--sage);
  border-color:var(--sage);
  color:#fff;
}

.stage.active .stage-circle {
  background:#fff;
  border-color:var(--sage);
  color:var(--sage-dark);
  box-shadow:0 0 0 4px rgba(122,158,135,0.2);
}

.stage-label {
  font-size:0.65rem;
  text-transform:uppercase;
  letter-spacing:0.8px;
  color:var(--muted);
  font-weight:700;
  text-align:center;
}

.stage.done .stage-label, .stage.active .stage-label { color:var(--sage-dark); }

/* ── ADMISSION PROGRESS SECTION ── */
.patient-card {
  background:var(--card);
  border:1px solid var(--border);
  border-radius:16px;
  padding:22px 26px;
  box-shadow:0 2px 16px var(--shadow);
  margin-bottom:16px;
  transition:transform 0.2s, box-shadow 0.2s;
}

.patient-card:hover { transform:translateY(-2px); box-shadow:0 8px 28px var(--shadow); }

.patient-card-top {
  display:flex;
  align-items:center;
  gap:16px;
  margin-bottom:16px;
}

.patient-avatar {
  width:48px; height:48px;
  border-radius:14px;
  display:flex; align-items:center; justify-content:center;
  font-size:1.3rem;
  flex-shrink:0;
}

.patient-avatar.male { background:rgba(122,158,135,0.15); }
.patient-avatar.female { background:rgba(232,180,160,0.2); }

.patient-name {
  font-family:'Playfair Display', serif;
  font-size:1.05rem;
  font-weight:600;
  color:var(--deep);
}

.patient-meta { font-size:0.8rem; color:var(--muted); margin-top:2px; }

.patient-card-right { margin-left:auto; text-align:right; }

.stage-badge {
  display:inline-block;
  padding:4px 12px;
  border-radius:99px;
  font-size:0.72rem;
  font-weight:700;
  text-transform:uppercase;
  letter-spacing:0.8px;
}

.stage-badge.admitted   { background:rgba(232,180,160,0.25); color:#a0522d; }
.stage-badge.diagnosed  { background:rgba(255,215,0,0.2);    color:#8b6914; }
.stage-badge.treatment  { background:rgba(122,158,135,0.2);  color:var(--sage-dark); }
.stage-badge.recovery   { background:rgba(79,122,98,0.15);   color:#2d5a3d; }
.stage-badge.discharged { background:rgba(200,200,200,0.3);  color:#555; }

/* Inline progress bar */
.progress-track {
  display:flex;
  gap:4px;
  align-items:center;
}

.progress-seg {
  flex:1;
  height:5px;
  border-radius:99px;
  background:rgba(0,0,0,0.07);
  transition:background 0.3s;
}

.progress-seg.filled { background:var(--sage); }
.progress-seg.filled.blush { background:var(--clay); }

.progress-label {
  font-size:0.72rem;
  color:var(--muted);
  margin-top:6px;
}

/* ── VIEW TABLE ── */
.view-header {
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin-bottom:20px;
  flex-wrap:wrap;
  gap:12px;
}

.search-box {
  display:flex;
  align-items:center;
  gap:10px;
  background:var(--card);
  border:1.5px solid var(--border);
  border-radius:10px;
  padding:9px 16px;
  min-width:240px;
}

.search-box input {
  background:none;
  border:none;
  color:var(--deep);
  font-family:'Nunito', sans-serif;
  font-size:0.88rem;
  width:100%;
  outline:none;
}

.search-box input::placeholder { color:var(--muted); }

.table-wrap {
  overflow-x:auto;
  border-radius:16px;
  border:1px solid var(--border);
  box-shadow:0 4px 24px var(--shadow);
  background:var(--card);
}

table { width:100%; border-collapse:collapse; }

thead tr {
  background:linear-gradient(135deg, rgba(122,158,135,0.1), rgba(232,180,160,0.08));
  border-bottom:1px solid var(--border);
}

th {
  padding:14px 18px;
  text-align:left;
  font-family:'Nunito', sans-serif;
  font-size:0.68rem;
  text-transform:uppercase;
  letter-spacing:1.5px;
  color:var(--sage-dark);
  white-space:nowrap;
  font-weight:800;
}

td {
  padding:13px 18px;
  font-size:0.88rem;
  color:var(--deep);
  border-bottom:1px solid rgba(122,158,135,0.08);
  white-space:nowrap;
}

tbody tr { transition:background 0.15s; animation:rowIn 0.3s ease both; }

@keyframes rowIn {
  from{opacity:0;transform:translateX(-8px);}
  to{opacity:1;transform:translateX(0);}
}

tbody tr:hover { background:rgba(122,158,135,0.04); }
tbody tr:last-child td { border-bottom:none; }

.badge {
  display:inline-flex;
  align-items:center;
  gap:5px;
  padding:3px 10px;
  border-radius:99px;
  font-size:0.75rem;
  font-weight:700;
}

.badge.male   { background:rgba(122,158,135,0.12); color:var(--sage-dark); }
.badge.female { background:rgba(232,180,160,0.2);  color:#a0522d; }

.btn-delete {
  padding:5px 13px;
  border:1.5px solid rgba(192,57,43,0.25);
  border-radius:8px;
  background:rgba(192,57,43,0.06);
  color:var(--danger);
  font-family:'Nunito', sans-serif;
  font-size:0.8rem;
  cursor:pointer;
  transition:all 0.2s;
  font-weight:700;
}

.btn-delete:hover {
  background:rgba(192,57,43,0.12);
  border-color:rgba(192,57,43,0.4);
}

.empty-state {
  text-align:center;
  padding:60px 20px;
  color:var(--muted);
}

.empty-state .empty-icon { font-size:3rem; margin-bottom:12px; opacity:0.5; }

/* ── BUTTONS ── */
.btn-submit {
  width:100%;
  padding:14px;
  border:none;
  border-radius:12px;
  background:linear-gradient(135deg, var(--sage), var(--sage-dark));
  color:#fff;
  font-family:'Nunito', sans-serif;
  font-size:1rem;
  font-weight:800;
  cursor:pointer;
  letter-spacing:0.3px;
  transition:all 0.25s;
  box-shadow:0 4px 20px rgba(79,122,98,0.3);
}

.btn-submit:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(79,122,98,0.35); }

.btn-danger {
  width:100%;
  padding:14px;
  border:none;
  border-radius:12px;
  background:linear-gradient(135deg, #e74c3c, #c0392b);
  color:#fff;
  font-family:'Nunito', sans-serif;
  font-size:1rem;
  font-weight:800;
  cursor:pointer;
  transition:all 0.25s;
  box-shadow:0 4px 20px rgba(192,57,43,0.25);
}

.btn-danger:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(192,57,43,0.35); }

/* ── DELETE SECTION ── */
.delete-card {
  background:var(--card);
  border:1px solid var(--border-warm);
  border-radius:20px;
  padding:36px;
  max-width:500px;
  margin:0 auto;
  box-shadow:0 4px 30px var(--shadow);
}

.delete-warning {
  background:rgba(192,57,43,0.06);
  border:1px solid rgba(192,57,43,0.18);
  border-radius:12px;
  padding:14px 18px;
  font-size:0.84rem;
  color:#a93226;
  margin-bottom:24px;
  display:flex;
  align-items:center;
  gap:10px;
  font-weight:600;
}

/* ── MODAL ── */
.modal-overlay {
  position:fixed; inset:0;
  background:rgba(45,58,53,0.5);
  backdrop-filter:blur(6px);
  z-index:200;
  display:flex;
  align-items:center;
  justify-content:center;
  opacity:0;
  pointer-events:none;
  transition:opacity 0.25s;
}

.modal-overlay.show { opacity:1; pointer-events:all; }

.modal {
  background:#fff;
  border:1px solid var(--border);
  border-radius:20px;
  padding:32px;
  max-width:400px;
  width:90%;
  transform:scale(0.92);
  transition:transform 0.25s cubic-bezier(0.175,0.885,0.32,1.275);
  box-shadow:0 20px 60px rgba(45,58,53,0.2);
}

.modal-overlay.show .modal { transform:scale(1); }
.modal-icon { font-size:2.5rem; margin-bottom:14px; }
.modal h3 { font-family:'Playfair Display',serif; font-size:1.2rem; margin-bottom:8px; color:var(--deep); }
.modal p { color:var(--muted); font-size:0.88rem; margin-bottom:24px; }
.modal-btns { display:flex; gap:10px; }

.modal-btns button {
  flex:1; padding:11px; border-radius:10px;
  font-family:'Nunito',sans-serif; font-size:0.9rem;
  font-weight:700; cursor:pointer; transition:all 0.2s;
  border:1.5px solid var(--border);
}

.btn-cancel { background:transparent; color:var(--muted); }
.btn-cancel:hover { background:rgba(0,0,0,0.04); color:var(--deep); }
.btn-confirm { background:rgba(192,57,43,0.08); color:var(--danger); border-color:rgba(192,57,43,0.25); }
.btn-confirm:hover { background:rgba(192,57,43,0.15); }

/* ── TOAST ── */
.toast {
  position:fixed;
  bottom:28px; right:28px;
  z-index:300;
  padding:14px 22px;
  border-radius:12px;
  font-size:0.88rem;
  font-weight:600;
  display:flex;
  align-items:center;
  gap:10px;
  transform:translateY(80px);
  opacity:0;
  transition:all 0.35s cubic-bezier(0.175,0.885,0.32,1.275);
  border:1px solid;
  max-width:340px;
  box-shadow:0 10px 40px rgba(0,0,0,0.12);
}

.toast.show { transform:translateY(0); opacity:1; }
.toast.success { background:rgba(122,158,135,0.12); border-color:rgba(122,158,135,0.3); color:var(--sage-dark); }
.toast.error   { background:rgba(192,57,43,0.08);   border-color:rgba(192,57,43,0.25);  color:var(--danger); }

/* ── PROGRESS PAGE ── */
.progress-filter {
  display:flex;
  gap:8px;
  margin-bottom:24px;
  flex-wrap:wrap;
}

.filter-pill {
  padding:7px 16px;
  border-radius:99px;
  border:1.5px solid var(--border);
  background:var(--card);
  font-family:'Nunito',sans-serif;
  font-size:0.78rem;
  font-weight:700;
  color:var(--muted);
  cursor:pointer;
  transition:all 0.2s;
}

.filter-pill:hover, .filter-pill.active {
  border-color:var(--sage);
  background:rgba(122,158,135,0.1);
  color:var(--sage-dark);
}

/* Stage select in form */
.stage-select-group {
  display:grid;
  grid-template-columns:repeat(5,1fr);
  gap:8px;
}

.stage-opt {
  padding:9px 6px;
  border-radius:10px;
  border:1.5px solid var(--border);
  background:rgba(255,255,255,0.5);
  font-family:'Nunito',sans-serif;
  font-size:0.72rem;
  font-weight:700;
  color:var(--mid);
  cursor:pointer;
  text-align:center;
  transition:all 0.2s;
}

.stage-opt input[type=radio] { display:none; }
.stage-opt:has(input:checked) { border-color:var(--sage); background:rgba(122,158,135,0.1); color:var(--sage-dark); }

/* Responsive */
@media(max-width:900px){
  .sidebar{ width:220px; }
  .main-wrap{ margin-left:220px; }
  .stats-row{ grid-template-columns:1fr 1fr; }
}
@media(max-width:650px){
  .sidebar{ position:relative; width:100%; height:auto; }
  .main-wrap{ margin-left:0; }
  .form-grid{ grid-template-columns:1fr; }
  .stats-row{ grid-template-columns:1fr; }
  .stage-select-group{ grid-template-columns:repeat(3,1fr); }
}
</style>
</head>
<body>

<!-- ═══ SIDEBAR ═══ -->
<div class="sidebar">
  <div class="logo-block">
    <div class="logo-top">
      <div class="logo-icon">🏥</div>
      <div>
        <div class="logo-name">MediCare</div>
        <div class="logo-tag">Hospital Management</div>
      </div>
    </div>
    <!-- Address Card -->
    <div class="address-card">
      <div class="address-line">
        <span class="ico">📍</span>
        <div><strong>42, Gandhi Salai</strong><br>RS Puram, Coimbatore – 641002</div>
      </div>
      <div class="address-line">
        <span class="ico">📞</span>
        <div><strong>0422 – 234 5678</strong></div>
      </div>
      <div class="address-line">
        <span class="ico">🌐</span>
        <div>medicare-cbe.in</div>
      </div>
      <div class="address-line">
        <span class="ico">🕐</span>
        <div>24 × 7 Emergency</div>
      </div>
    </div>
  </div>

  <nav class="nav-menu">
    <div class="nav-label">Patient Care</div>
    <button class="nav-btn active" onclick="showSection('insert')" id="nav-insert">
      <span class="nav-ico">✚</span> Register Patient
    </button>
    <button class="nav-btn" onclick="showSection('view')" id="nav-view">
      <span class="nav-ico">◈</span> View Records
    </button>
    <button class="nav-btn" onclick="showSection('progress')" id="nav-progress">
      <span class="nav-ico">📊</span> Admission Progress
    </button>
    <div class="nav-label">Manage</div>
    <button class="nav-btn" onclick="showSection('delete')" id="nav-delete">
      <span class="nav-ico">⊗</span> Delete Record
    </button>
  </nav>

  <div class="sidebar-footer">© 2025 MediCare HMS · Coimbatore</div>
</div>

<!-- ═══ MAIN ═══ -->
<div class="main-wrap">

  <!-- Top Bar -->
  <div class="topbar">
    <div>
      <div class="topbar-title" id="topbar-title">Register New Patient</div>
      <div class="topbar-meta" id="topbar-meta">Fill in patient details to create an appointment</div>
    </div>
    <div class="topbar-right">
      <div class="status-pill"><div class="status-dot"></div> System Online</div>
    </div>
  </div>

  <div class="content">

    <!-- ══ INSERT SECTION ══ -->
    <div class="section active" id="section-insert">

      <!-- Admission Flow Progress -->
      <div class="progress-stages">
        <div class="stage done">
          <div class="stage-circle">✓</div>
          <div class="stage-label">Registration</div>
        </div>
        <div class="stage active">
          <div class="stage-circle">2</div>
          <div class="stage-label">Diagnosis</div>
        </div>
        <div class="stage">
          <div class="stage-circle">3</div>
          <div class="stage-label">Treatment</div>
        </div>
        <div class="stage">
          <div class="stage-circle">4</div>
          <div class="stage-label">Recovery</div>
        </div>
        <div class="stage">
          <div class="stage-circle">5</div>
          <div class="stage-label">Discharge</div>
        </div>
      </div>

      <div class="form-card">
        <form action="insert.php" method="post" id="insertForm">
          <div class="form-section-label">👤 Patient Information</div>
          <div class="form-grid">
            <div class="form-group">
              <label>Patient Name</label>
              <input type="text" name="pname" placeholder="Enter full name" required>
            </div>
            <div class="form-group">
              <label>Age</label>
              <input type="number" name="age" placeholder="Age" min="0" max="150" required>
            </div>
            <div class="form-group">
              <label>Gender</label>
              <div class="gender-group">
                <label class="gender-pill">
                  <input type="radio" name="gender" value="Male" checked> ♂ Male
                </label>
                <label class="gender-pill">
                  <input type="radio" name="gender" value="Female"> ♀ Female
                </label>
              </div>
            </div>
            <div class="form-group">
              <label>Appointment Date</label>
              <input type="date" name="appointment_date" required>
            </div>
          </div>

          <div class="form-section-label">🩺 Medical Details</div>
          <div class="form-grid">
            <div class="form-group">
              <label>Disease / Condition</label>
              <input type="text" name="disease" placeholder="e.g. Hypertension, Fever..." required>
            </div>
            <div class="form-group">
              <label>Assigned Doctor</label>
              <input type="text" name="doctor" placeholder="Dr. Name" required>
            </div>
            <div class="form-group full">
  <label>Admission Stage</label>
  <div class="stage-select-group">
    <label class="stage-opt">
      <input type="radio" name="stage" value="Admitted" checked> 🏥 Admitted
    </label>
    <label class="stage-opt">
      <input type="radio" name="stage" value="Diagnosed"> 🔬 Diagnosed
    </label>
    <label class="stage-opt">
      <input type="radio" name="stage" value="Treatment"> 💊 Treatment
    </label>
    <label class="stage-opt">
      <input type="radio" name="stage" value="Recovery"> 🌿 Recovery
    </label>
    <label class="stage-opt">
      <input type="radio" name="stage" value="Discharged"> ✅ Discharged
    </label>
  </div>
</div>
            <div class="form-group full">
              <button type="submit" class="btn-submit" name="submit">✚ &nbsp; Register Patient</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- ══ VIEW SECTION ══ -->
    <div class="section" id="section-view">
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-icon green">👥</div>
          <div>
            <div class="stat-num" id="total-count">0</div>
            <div class="stat-label">Total Patients</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon blush">♂</div>
          <div>
            <div class="stat-num" id="male-count">0</div>
            <div class="stat-label">Male Patients</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon clay">♀</div>
          <div>
            <div class="stat-num" id="female-count">0</div>
            <div class="stat-label">Female Patients</div>
          </div>
        </div>
      </div>

      <div class="view-header">
        <div>
          <div class="page-title">Patient Records</div>
          <div class="page-sub">All registered appointments</div>
        </div>
        <div class="search-box">
          🔍 <input type="text" id="searchInput" placeholder="Search patients..." oninput="filterTable()">
        </div>
      </div>

      <div class="table-wrap">
        <table id="patientTable">
          <thead>
            <tr>
              <th>#ID</th><th>Patient Name</th><th>Age</th><th>Gender</th>
              <th>Disease</th><th>Doctor</th><th>Stage</th><th>Date</th><th>Action</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <?php include 'view.php'; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ══ PROGRESS SECTION ══ -->
    <div class="section" id="section-progress">
      <div class="page-header">
        <div class="page-title">Admission Progress</div>
        <div class="page-sub">Track each patient's journey through treatment stages</div>
      </div>

      <div class="progress-filter">
        <button class="filter-pill active" onclick="filterProgress('all',this)">All Patients</button>
        <button class="filter-pill" onclick="filterProgress('Admitted',this)">🏥 Admitted</button>
        <button class="filter-pill" onclick="filterProgress('Diagnosed',this)">🔬 Diagnosed</button>
        <button class="filter-pill" onclick="filterProgress('Treatment',this)">💊 Treatment</button>
        <button class="filter-pill" onclick="filterProgress('Recovery',this)">🌿 Recovery</button>
        <button class="filter-pill" onclick="filterProgress('Discharged',this)">✅ Discharged</button>
      </div>

      <div id="progressCards">
        <?php include 'progress.php'; ?>
      </div>
    </div>

    <!-- ══ DELETE SECTION ══ -->
    <div class="section" id="section-delete">
      <div class="page-header">
        <div class="page-title">Delete Patient Record</div>
        <div class="page-sub">Permanently remove a patient from the system</div>
      </div>
      <div class="delete-card">
        <div class="delete-warning">⚠️ &nbsp; This action cannot be undone. Please enter the Patient ID carefully.</div>
        <form action="delete.php" method="get" id="deleteForm" onsubmit="return false;">
          <div class="form-group" style="margin-bottom:20px">
            <label>Patient ID to Delete</label>
            <input type="number" name="id" id="deleteId" placeholder="Enter Patient ID" min="1" required>
          </div>
          <button type="button" class="btn-danger" onclick="confirmDeleteById()">🗑 &nbsp; Delete Patient Record</button>
        </form>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main-wrap -->

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal">
    <div class="modal-icon">⚠️</div>
    <h3 id="modalTitle">Confirm Deletion</h3>
    <p id="modalMsg">Are you sure you want to delete this patient record?</p>
    <div class="modal-btns">
      <button class="btn-cancel" onclick="closeModal()">Cancel</button>
      <button class="btn-confirm" id="modalConfirm">Delete</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
  <span id="toastIcon">✓</span>
  <span id="toastMsg">Done.</span>
</div>

<script>
const topbarTitles = {
  insert:   ['Register New Patient',     'Fill in patient details to create an appointment'],
  view:     ['Patient Records',          'All registered patients in the system'],
  progress: ['Admission Progress',       'Track each patient\'s treatment journey'],
  delete:   ['Delete Patient Record',    'Permanently remove a patient from the system'],
};

function showSection(name) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('section-' + name).classList.add('active');
  document.getElementById('nav-' + name).classList.add('active');
  const [t, m] = topbarTitles[name];
  document.getElementById('topbar-title').textContent = t;
  document.getElementById('topbar-meta').textContent = m;
  if (name === 'view') updateStats();
}

function updateStats() {
  const rows = document.querySelectorAll('#tableBody tr');
  let male = 0, female = 0;
  rows.forEach(r => {
    const g = r.querySelector('.badge');
    if (g) { if (g.classList.contains('male')) male++; else female++; }
  });
  document.getElementById('total-count').textContent = rows.length;
  document.getElementById('male-count').textContent = male;
  document.getElementById('female-count').textContent = female;
}

function filterTable() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  document.querySelectorAll('#tableBody tr').forEach(row => {
    row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}

function filterProgress(stage, btn) {
  document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.patient-card').forEach(card => {
    card.style.display = (stage === 'all' || card.dataset.stage === stage) ? '' : 'none';
  });
}

let _deleteAction = null;

function confirmDelete(id, name) {
  document.getElementById('modalTitle').textContent = 'Delete Patient #' + id;
  document.getElementById('modalMsg').textContent = 'Are you sure you want to delete "' + name + '"? This cannot be undone.';
  document.getElementById('modalConfirm').onclick = () => { window.location.href = 'delete.php?id=' + id; };
  document.getElementById('modalOverlay').classList.add('show');
}

function confirmDeleteById() {
  const id = document.getElementById('deleteId').value;
  if (!id) { showToast('Please enter a Patient ID.', 'error'); return; }
  document.getElementById('modalTitle').textContent = 'Delete Patient #' + id;
  document.getElementById('modalMsg').textContent = 'Permanently delete Patient ID ' + id + '?';
  document.getElementById('modalConfirm').onclick = () => { window.location.href = 'delete.php?id=' + id; };
  document.getElementById('modalOverlay').classList.add('show');
}

function closeModal() { document.getElementById('modalOverlay').classList.remove('show'); }
document.getElementById('modalOverlay').addEventListener('click', e => { if (e.target === e.currentTarget) closeModal(); });

function showToast(msg, type='success') {
  const t = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = msg;
  document.getElementById('toastIcon').textContent = type === 'success' ? '✓' : '⚠';
  t.className = 'toast ' + type + ' show';
  setTimeout(() => t.classList.remove('show'), 3500);
}

const urlParams = new URLSearchParams(window.location.search);
const urlStatus = urlParams.get('status');
const urlSection = urlParams.get('section');

if (urlStatus === 'inserted') showToast('Patient registered successfully!', 'success');
if (urlStatus === 'deleted')  showToast('Patient record deleted.', 'success');
if (urlStatus === 'error')    showToast('Something went wrong. Try again.', 'error');
if (urlSection) showSection(urlSection);

document.querySelector('input[type=date]').valueAsDate = new Date();
updateStats();
</script>
</body>
</html>
