#!/bin/bash

#read IA32_PMCX
for ((j=0; j<8; j+=4))
do
 if ((j%4 == 0))
 then
  r1=`rdmsr -p $j -u 0x3B0`; #UNC_GQ_OCCUPANCY_READ_TRACKER, 0x2, 0x1, UPMC 
  r2=`rdmsr -p $j -u 0x3B1`; #UNC_GQ_ALLOC_READ_TRACKER, 0x3, 0x1, UPMC
  r3=`rdmsr -p $j -u 0x3B2`; #UNC_GQ_ALLOC_RT_L3_MISS, 0x3, 0x2, UPMC 
  r4=`rdmsr -p $j -u 0x3B3`; 
  r5=`rdmsr -p $j -u 0x3B4`; 
  r6=`rdmsr -p $j -u 0x3B5`; 
# echo "Event0            Event1             Event2           Event3";
# echo "p$j E1:$r1    E2:$r2    E3:$r3    E4:$r4   E5:$r5   E6:$r6";
# sleep 2;
echo "scale=2;$r1/$r2+$r3/$r4+$r5/$r6"|bc;
 fi;
done;

