#!/bin/bash 

# Helper Script for calculating the current cpu usage over one interval. 
# Future expansion: Add options for number of intervals

for index in {1..2}
do
    cpu_now=($(head -n1 /proc/stat)) 
    cpu_sum="${cpu_now[@]:1}" 
    cpu_sum=$((${cpu_sum// /+})) 
    cpu_delta=$((cpu_sum - cpu_last_sum)) 
    cpu_idle=$((cpu_now[4]- cpu_last[4])) 
    cpu_used=$((cpu_delta - cpu_idle)) 
    cpu_usage=$((100 * cpu_used / cpu_delta)) 

    cpu_last=("${cpu_now[@]}") 
    cpu_last_sum=$cpu_sum 

    sleep 1
done

echo "$cpu_usage"
