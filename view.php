<?php

function view(string $viewPath, $attr = []) {
    extract($attr);
    require "{$viewPath}";
}