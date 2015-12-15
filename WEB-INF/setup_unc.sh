#!/bin/bash
a=1
b=0xffff
for (( j=0; j<8; j++ )) do
#MSR_UNCORE_PERF_GOBAL_CTL
#rdmsr -p $j 0x391;
#PERFEVTSELX
# for (( i=0; i<4; i++ ))
# do
  wrmsr -p $j 0x3C0 0x400102; #UNC_GQ_OCCUPANCY_READ_TRACKER
  wrmsr -p $j 0x3C1 0x400103; #UNC_GQ_ALLOC_READ_TRACKER
  wrmsr -p $j 0x3C2 0x402002; #UNC_GQ_OCCUPANCY_write_TRACKER
  wrmsr -p $j 0x3C3 0x402003; #UNC_GQ_Alloc_READ_TRACKER
  wrmsr -p $j 0x3C4 0x404002; #UNC_GQ_OCCUPANCY_ppt
  wrmsr -p $j 0x3C5 0x404003; #UNC_GQ_alloc_ppt
# done;
  wrmsr -p $j 0x3B0 0x0;
  wrmsr -p $j 0x3B1 0x0;
  wrmsr -p $j 0x3B2 0x0;
  wrmsr -p $j 0x3B3 0x0;
  wrmsr -p $j 0x3B4 0x0;
  wrmsr -p $j 0x3B5 0x0;
  if ((j%4==0)); then ((a = ! $b)); fi;
done;
  wrmsr -a 0x391 0x07F;
