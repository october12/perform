#!/bin/bash
for ((j=7; j>=0; j--)) do
#MSR_UNCORE_PERF_GOBAL_CTL
wrmsr -p $j 0x391 0x0;
done;
