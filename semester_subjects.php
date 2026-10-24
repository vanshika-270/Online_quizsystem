<?php
/** Subject catalog used by quiz creation and student quiz filtering. */
function semester_subject_map(): array {
    return [
        1 => ['Maths', 'English', 'Physics', 'CPF'],
        2 => ['Advanced Maths', 'Chemistry'],
        3 => ['RDBMS', 'CN', 'DS', 'FOS'],
        4 => ['Java', 'SE', 'IML', 'ENT', 'CC'],
        5 => ['IOT', 'WDP', 'CHASM', 'IS'],
        6 => ['Degree Level Quiz'],
    ];
}
function semester_number($value): int {
    $n = (int)preg_replace('/[^0-9]/', '', (string)$value);
    return $n > 0 ? $n : 1;
}
function subjects_for_semester($value): array {
    $map = semester_subject_map();
    return $map[semester_number($value)] ?? [];
}
