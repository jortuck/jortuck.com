<script setup lang="ts">
defineProps({
	src: String
});
</script>
<template>
	<video
		class="rounded-md"
		:src="src"
		controls
	>
		/>
	</video>
</template>
