<?php
/**********************************************

Jon Lazar

Dwarf Palindromes at the Prancing Pony

April 2017

**********************************************/

// The dwarves in the Prancing Pony
$dwarves = ['Gimli', 'Fili', 'Ilif', 'Ilmig', 'Mark'];

//First we are going to build a list of every possible combinations of the array of names from 2 to 5 names
foreach(range(2, 5) as $n)
    foreach(comb($n, $dwarves) as $c)
        $dwarflist[] = $c;

//Then we will take each cardinal array of names and check each possible permutation for palindromes
foreach($dwarflist as $dwarf) {
	pc_permute($dwarf);
}


//pc_permute takes an array and finds every permutation of that array
//each permutation calls the palindrome function to see if the combination is one
function pc_permute($items, $perms = array()) {
    if (empty($items)) { 
        $curdwarf = join(' ', $perms);
	if (palindrome($curdwarf)) {
		echo $curdwarf."\n";
	}
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             pc_permute($newitems, $newperms);
         }
    }
}

// comb function takes an array and finds each unique array combination of the array
function comb($m, $a) {
    if (!$m) {
        yield [];
        return;
    }
    if (!$a) {
        return;
    }
    $h = $a[0];
    $t = array_slice($a, 1);
    foreach(comb($m - 1, $t) as $c)
        yield array_merge([$h], $c);
    foreach(comb($m, $t) as $c)
        yield $c;
}

// palindrome takes in a string and returns whether or not it is a palindrome by checking the forward and reverse of the string against each other
// since it's a list of names, we are receiving it space delineated and remove the spaces
function palindrome ($string) {

	$forward = str_replace(' ', '', strtolower($string));
	$reverse = strrev ($forward);

	if ($forward == $reverse) {
		$out = 1;
	} else {
		$out = 0;
	}

	return $out;
}

