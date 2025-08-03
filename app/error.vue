<script setup lang="ts">
import type { NuxtError } from "#app";

const props = defineProps({
	error: Object as () => NuxtError
});

const handleError = () => clearError({ redirect: "/" });
</script>

<template>
	<div class="flex h-screen w-full flex-col items-center justify-center space-y-5">
		<h1
			class="bg-gradient-to-br from-white via-primary to-white bg-clip-text text-9xl font-extrabold text-transparent"
		>
			{{ error.statusCode }}
		</h1>
		<h2 class="text-3xl font-bold text-white">{{ error.message }}</h2>
		<button
			class="block w-fit rounded-md bg-base-200 p-3 text-white hover:bg-base-300"
			@click="handleError"
		>
			<i class="fa-solid fa-home"></i> Return Home
		</button>
	</div>
</template>
