<?php
$all = DB::table('mahasiswas')->select('nim', 'nama', 'status_magang')->get();
foreach ($all as $m) {
    echo "{$m->nim} | {$m->nama} | {$m->status_magang}\n";
}
