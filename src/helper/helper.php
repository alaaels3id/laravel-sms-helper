<?php

function create_rand_numbers($digits = 4): int
{
    return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
}
