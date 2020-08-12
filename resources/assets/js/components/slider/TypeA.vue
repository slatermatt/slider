<template>
	<draggable
		:items="$props.items"
		v-bind="$props.options"
	>
		<placeholder
			slot-scope="{ img }"
			class="pt-9/16"
		>
			<img
				:src="img"
				alt="placeholder"
			>
		</placeholder>
	</draggable>
</template>

<script>
	import Draggable from '../common/Draggable';

	export default {
		components: {
			Draggable,
		},

		props: {
			items: {
				type: Array,
				default: null,
			},

			options: {
				type: Object,
				default: null,
			},
		},
	};
</script>
