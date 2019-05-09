# Omni-Board

Omni-Board: The dashboard for your raspberry pi vitals. The way it works is simple: You install an agent on your raspberry pi, setup the dashboard on a webserver (maybe on that very pi) and voila! You got yourself a nifty, little dashboard.

## Getting Started

To ensure the best possible experience, please follow the following steps in chronological order, otherwise, there might be complications, which would force you to redo all the steps, and we really don't want any more headaches, right? :)

### Installing the agent on the raspberry pi

- First of all, clone this repository to your raspberry pi. To do so, make sure you have git installed. If not, install it using this command `sudo apt-get install git`. Then run `git clone https://github.com/yhuggler/omni-board.git`
- Now, assuming you cloned it into your home directory, the cloned directory should be at `/home/pi/omni-board/`
- CD into the new directory `cd omni-board/`
- Run the following command: `chmod +x -R /raspberry-pi-agent` in order to fix all the permission issues in linux.

