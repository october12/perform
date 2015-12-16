#!/bin.bash
benchs=('astar.base' 'milc' 'sss' 'bbb' 'ddd')
param=$1;
for ((i=0;i<${#param};i++ ))
do
	index=${param:$i:1}
	let index--;
	pidof ${benchs[$index]}
done

