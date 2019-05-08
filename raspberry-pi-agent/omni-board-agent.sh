#!/bin/bash

# ========================================================
# Configuratiion of the Omni-Board-Raspberry-Pi-Agent
# Only alter parameters in this sections.
# ========================================================

AUTH_TOKEN="<INSERT_YOUR_AUTH_TOKEN>"
SERVER_ADDRESS="<INSERT_YOUR_SERVER_ADDRESS>"

# ========================================================
# End of the configuration section. Everything after this
# line should only be touched at your own risk.
# ========================================================


# Global Variables

enable_verbose_output=false

# Helper functions

function print_help() {
    echo "usage: ./omni-board-agent [option]"
    echo "Options and arguments (and corresponding environment variables):"
    echo "-v    : Enable verbose outout. Can increase memory and cpu usage. Only for developement purposes."
    echo "-h    : Prints a short documentation over the available options and the usage."
    exit
}

function retrieve_system_vitals() {
    declare -A vitals

    # CPU Temperature
    cpu_temperature=$(</sys/class/thermal/thermal_zone0/temp)
    cpu_temperature=$((cpu_temperature / 1000))
    
    vitals[cpu_temperature]=$cpu_temperature;

    cpu_frequency=$(</sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq)
    cpu_frequency=$((cpu_frequency / 1000))

    vitals[cpu_frequency]=$cpu_frequency

    cpu_load_averages=$(top -b | head -n 5 | grep 'load average:' | sed 's/^.*: //')
    # readarray -td, cpu_loads <<<"$cpu_load_averages"; declare -p cpu_loads;
}

function post_vitals_to_server() {
    # curl -u -H --data ${url} 
}


# Setup options
while [ -n "$1" ]; do
    case "$1" in
        -v) enable_verbose_output=true ;; 
        -h) print_help ;; 
    esac
    shift
done

retrieve_system_vitals
