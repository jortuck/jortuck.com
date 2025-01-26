<template>
	<section class="my-10 space-y-4">
		<NuxtLink
			href="/projects"
			class="block rounded-md text-white hover:underline md:text-lg"
			><i class="fa-solid fa-arrow-left"></i> Back To Projects</NuxtLink
		>
		<ContentDoc class="space-y-4">
			<template v-slot:not-found>
				<div class="flex w-full flex-col items-center space-y-10 pt-10">
					<h1 class="text-center text-3xl font-bold text-white md:text-5xl">Project Not Found</h1>
					<NuxtLink
						to="/projects"
						class="bg-base-200 hover:bg-base-300 block w-fit rounded-md p-3 text-white"
						><i class="fa-solid fa-arrow-left"></i> Back To Projects</NuxtLink
					>
				</div>
			</template>
		</ContentDoc>
	</section>
</template>
<script setup lang="ts"></script>
