---
title: 'Paleoclimate Visualizer'
description: 'An open-source web app for visualizing climate data reconstructions, built during my time as an Undergraduate Research Assistant for the University of Washington School of Oceanography.'
github: 'PaleoclimateVisualizer'
image:
  src: 'https://jortuck.com/thumbnails/pv.png'
  type: 'image/png'
---

::ProjectHeader

# Paleoclimate Visualizer

:Tag{text="AWS"} :Tag{text="Cloudflare"} :Tag{text="FastAPI"} :Tag{text="Python"} :Tag{text="Svelte"} :Tag{text="
TypeScript"} :Tag{text="TailwindCSS"}
:CenteredImage{src="/thumbnails/pv.png"}
::TagButtonGroup
:TagButton{url="https://github.com/jortuck/PaleoClimateVisualizer" text="Source Code" icon="fa-brands fa-github"}
:TagButton{url="https://github.com/jortuck/PaleoClimateVisualizerAPI" text="API Source Code" icon="fa-brands fa-github"}
:TagButton{url="https://pv.jortuck.com" text="Live Website" icon="fa-solid fa-globe"}
:TagButton{url="https://agupubs.onlinelibrary.wiley.com/doi/10.1029/2021GL095999" text="Original Study" icon="fa-solid
fa-newspaper"}
::
::

## About

This is the project I developed while working as an Undergraduate Research assistant for the University of Washington's
School of Oceanography during the Summer of 2024. The goal was to create a web application for visualizing paleocliamte
data reconstructions. I worked closely with my advisor, Gemma O'Connor, to create an app capable of telling the full,
accurate story of the data. I decided to use Svelte for the front end because of its reputation of high performance, and
the Python library FastAPI for the data API because of the vast data science tools that already exists in the Python
ecosystem. This combination allowed for a fast user experience while delivering full visualizations. The app uses the
Highcharts library to display data, as we found it provides the cleanest for plotting gridded data that needs to be
interpolated across a surface. Even though my position has officially ended, I still work to maintain the open source
project, ensuring fixes and additions are made when needed.

## Research Abstract

Paleoclimate reconstructions are important for placing recent observed climatic changes within the context of long-term
variability. Because the instrumental climate record is short – particularly in remote data-sparse regions of the world
such as Antarctica – various gridded products that combine proxy observations (e.g., ice core records) with climate
model simulations have been developed to extend the instrumental record (Hakim et al,
2017; [O’Connor et al. 2021](https://agupubs.onlinelibrary.wiley.com/doi/10.1029/2021GL095999){target="_blank"};
Dalaiden et al., 2021). Using the reconstructions developed
by [O’Connor et al. 2021](https://agupubs.onlinelibrary.wiley.com/doi/10.1029/2021GL095999){target="_blank"}, we
developed a web application for
viewing, analyzing, and downloading the data. The web app has a Python-based backend application programming interface (
API) hosted on a cloud-based server. We find that this framework allows the users to specify a wide range of inputs,
such as data source, climate variables, map choices, time series locations, trends, and statistics, with a rapid
response time. We custom built the API to allow users to query data without downloading the entire dataset, which
reduces request payload size and bandwidth usage. We built the front-end using Svelte, Tailwind CSS, and HighCharts
frameworks, which enabled us to efficiently design a web application that displays interactive maps with adjacent time
series plots corresponding to user-specified inputs from the back-end API. The code used to build the web app is
open-source and adaptable for including additional gridded climate datasets. The web app is available
at [pv.jortuck.com](https://pv.jortuck.com/){target="blank"}. 