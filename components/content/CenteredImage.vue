<script setup lang="ts">
defineProps({
	src: String
});
</script>
<template>
	<div
		:style="`background-image: url(${src})`"
		class="h-52 overflow-hidden rounded-md bg-white md:h-80"
	>
		<div class="relative h-full backdrop-blur-2xl">
			<img
				alt="{imgAlt}"
				class="relative z-40 mx-auto h-full object-contain"
				:src
			/>
		</div>
	</div>
</template>
