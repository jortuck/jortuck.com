---
title: 'My Home Lab'
description: 'A growing home lab that includes a Proxmox server, OPNsense firewall, and custom networking equipment.'
image:
  src: 'https://jortuck.com/thumbnails/server.jpg'
  type: 'image/jpg'
---

::ProjectHeader

# My Home Lab

:Tag{text="Docker"} :Tag{text="Linux"} :Tag{text="Networking"} :Tag{text="Proxmox"}
:CenteredImage{src="/thumbnails/server.jpg"}
::

## About

I started working on my home lab when I was looking to save money spent on traditional hosting providers. My home lab
was
originally an old Windows 7 laptop which I installed Ubuntu Server on because my parents no longer needed it, and now it
has grown into an operation that allows me to host resource intensive game servers and personal projects for free
(barring
the costs of electricity, internet, and the occasional upgrade).

What was originally a small side project has grown into
a huge hobby of mine, and while I still love to explore traditional cloud providers like AWS, this is pretty fun too.
If you personally know me and need something hosted, I would love to chat to see if it's something I can help you with.

For those who are interested, here is a list of the equipment I have and what I run:
- **Main Server**: My main sever (pictured above) sits inside a PC case I used to use. I currently have Proxmox
  installed
  on it which makes it easy to spin up virtual machines when I need them. I use it to run services such as Teamcity,
  Pterodactyl Panel, UniFi Network Server, Strapi, and game servers for playing with friends, along with any personal
  projects I need hosted. I currently have an AMD
  Ryzen 3800x with 64GB of memory installed which allows me to run sever intensive processes in parallel.
- **Dell Optiplex 7040**: I purchased this old desktop from my university's surplus store. I installed a new SSD on it
  and now it runs Proxmox Backup Server.
- **Protectli V1410 4 Port Intel® N5105:** I use this Protectli product to run my OPNsense firewall that sits in front
  of my entire home network.
- **Mikrotik CSS610-8G-2S+IN**: My chosen switch to keep everything connected.
- **Ubiquiti UniFi 6 Pro Access Point**: For providing general WiFi connectivity to my household.