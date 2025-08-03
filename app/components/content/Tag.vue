<script setup lang="ts">
defineProps({
	text: String
});
</script>
<template>
	<span class="select-none rounded-md bg-base-200 px-2 py-1 text-sm font-bold text-white">
		{{ text }}
	</span>
</template>
