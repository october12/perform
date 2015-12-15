#!/bin/bash
numactl -H|awk '{if(NR==3)size0=$4; else if(NR==4)free0=$4; else if(NR==6) size1=$4; else if(NR==7)free1=$4;} END{print (size0-free0)/1000, (size1-free1)/1000}'
