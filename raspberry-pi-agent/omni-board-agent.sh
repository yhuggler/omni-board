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


declare -A vitals

function retrieve_system_vitals() {

    # CPU Temperature
    cpu_temperature=$(</sys/class/thermal/thermal_zone0/temp)
    cpu_temperature=$((cpu_temperature / 1000))
    
    vitals[cpu_temperature]=$cpu_temperature;

    cpu_frequency=$(</sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq)
    cpu_frequency=$((cpu_frequency / 1000))

    vitals[cpu_frequency]=$cpu_frequency
    vitals[cpu_load]=`./cpu_usage.sh`
}

function post_vitals_to_server() {
    for key in "${!vitals[@]}"
    do
        echo "key  : $key"
        echo "value: ${vitals[$key]}"
        # curl -X POST -H "Content-Type: application/json" \ --data '{ "color":"red", "message":"Build failed '"$now"'", "message_format":"text" }' \ https://api.hipchat.com/v2/room/<room>/notification?auth_token=<token>
    done
    
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
post_vitals_to_server


