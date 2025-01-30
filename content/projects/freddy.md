---
title: "Freddy Bot"
description: "A free and open-source music bot built with Java for streaming music into your discord calls."
github: "freddy"
image:
  src: "https://jortuck.com/thumbnails/freddy.png"
  type: "image/png"
---

::ProjectHeader

# Freddy Bot

:Tag{text="Discord API"} :Tag{text="Docker"} :Tag{text="Java"}
:CenteredImage{src="/thumbnails/freddy.png"}
::TagButtonGroup
:TagButton{url="https://github.com/jortuck/freddy" text="Source Code" icon="fa-brands fa-github"}
::
::

## About

This bot was created using [Discord JDA](https://github.com/discord-jda/JDA){target="\_blank"} (Java Discord API). I was
inspired to make it after Google started cracking down
on music bots that were using YouTube as an audio source. Because of this, my friends and I could no longer listen to
music together in a discord call. While this bot I created still uses YouTube as an audio source, I doubt Google will
send me a cease and desists letter because it's used personally, not commercially. The repository includes instructions
on how users can self-host the bot using Docker or any local Java runtime version 21 or up. 

Some features include:
- Plays any song of your choice, as long as it's on YouTube.
- YouTube searching enabled, no need to lookup URLs.
- YouTube/Spotify playlist support for quickly adding your favorite songs to the queue.
- Discord slash command support making it easy to control your music.
- Queue up to 500 (can be configured) songs for you and your friends to listen to.


## Demo Video

:VideoViewer{src="/videos/FreddyDemo.mp4" }
