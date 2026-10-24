<?php
require_once "../db.php";
require_role("Teacher");
$conn->query("ALTER TABLE practice_material ADD COLUMN file_path VARCHAR(255) DEFAULT NULL");
$id=(int)($_GET["id"]??0);
$st=$conn->prepare("SELECT * FROM practice_material WHERE id=?");
$st->bind_param("i",$id); $st->execute(); $m=$st->get_result()->fetch_assoc();
if(!$m){http_response_code(404);die("Material not found. <a href='practice_material.php'>Back</a>");}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($m['title'])?></title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/style.css" rel="stylesheet"></head><body><div class="container-fluid"><div class="row"><div class="col-lg-2 p-0"><?php include "../partials/teacher_sidebar.php";?></div><main class="col-lg-10"><div class="py-4 px-lg-3"><a href="practice_material.php" class="btn btn-outline-secondary mb-3">← Back to Practice Material</a><div class="card panel-card"><div class="card-body p-4"><span class="badge bg-primary"><?=e($m['subject']?:'General')?></span><h2 class="fw-bold mt-3"><?=e($m['title'])?></h2><p class="text-muted"><?=e($m['description'])?></p><?php if(!empty($m['file_path'])): ?><a class="btn btn-danger mb-3" target="_blank" href="../<?=e($m['file_path'])?>">Open / Download PDF</a><iframe title="Practice PDF" src="../<?=e($m['file_path'])?>" style="width:100%;height:70vh;border:1px solid #ddd;border-radius:10px"></iframe><?php endif; ?><?php if(trim($m['content']??'')!==''): ?><div class="mt-4"><?=nl2br(e($m['content']))?></div><?php endif; ?></div></div></div></main></div></div><script src="../assets/card-links.js"></script></body></html>
