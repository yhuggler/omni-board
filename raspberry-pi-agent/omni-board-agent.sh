#!/bin/bash

# ========================================================
# Configuratiion of the Omni-Board-Raspberry-Pi-Agent
# Only alter parameters in this sections.
# ========================================================

AUTH_TOKEN="<INSERT_YOUR_AUTH_TOKEN>"
SERVER_ADDRESS="<INSERT_YOUR_SERVER_ADDRESS>"
UPDATES_PER_MINUTE=2                                          # 2 is default and recommended

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
}

function retrieve_system_vitals() {
    
}


# Setup options
while [ -n "$1" ]; do
    case "$1" in

    -v) enable_verbose_output=true ;; 
    -h) print_help ;; 
    esac
    shift
done

# Main Logic Loop
while true; do
    
done
