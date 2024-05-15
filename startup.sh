#!/bin/bash

# Ensure the Docker socket has the correct permissions
chmod 666 /var/run/docker.sock

# Start Apache in the foreground
apache2-foreground

