<template>
	<section class="overflow-x-hidden relative">
		<ol
			ref="slider"
			:class="$props.classList.wrapper"
		>
			<li
				v-for="(item, i) in cItems"
				:key="i"
				ref="slides"
				:class="$props.classList.item"
			>
				<slot v-bind="item" />
			</li>
		</ol>

		<nav
			v-if="$props.controls"
			:class="[
				'flex items-end',
				'absolute inset-0 pointer-events-none',
			]"
		>
			<button
				v-for="(btn, i) in 2"
				:key="i"
				:class="[
					'inline-flex pointer-events-auto',
					'p-4 bg-black text-white',
					{
						'ml-auto': i,
					},
				]"
				:disabled="disabilityHandler(i)"
				@click="onSkip(i, true)"
			>
				<icon :name="`chevron-${ i ? 'right' : 'left' }`" />
			</button>
		</nav>
	</section>
</template>

<script>
	import {
		gsap,
		Draggable,
		InertiaPlugin,
	} from 'gsap/all';

	import viewport from '../../mixins/viewport';

	gsap.registerPlugin(Draggable, InertiaPlugin);

	export default {
		mixins: [
			viewport,
		],

		props: {
			classList: {
				type: Object,
				default: () => ({}),
			},

			items: {
				type: Array,
				required: true,
			},

			itemsToSlide: {
				type: Number,
				default: 1,
			},

			playSpeed: {
				type: Number,
				default: 4000,
			},

			duplicates: {
				type: Number,
				default: 0,
			},

			controls: Boolean,
			infinite: Boolean,
			autoPlay: Boolean,
		},

		data() {
			return {
				index: 0,
				total: null,
				draggable: null,
				gridWidth: null,
				trackWidth: null,
				direction: true,
			};
		},

		computed: {
			// returns a list of items based on duplicates
			cItems() {
				const { duplicates, items } = this.$props;

				const active = [0 - items.length, 0, items.length]
					.map(v => v + this.$data.index + duplicates);

				return [
					...items.slice(items.length - duplicates),
					...items,
					...items.slice(0, duplicates),
				].map((item, i) => ({
					...item,
					active: active.includes(i),
				}));
			},

			// boolean for if we're at the first slide
			lowerLimit() {
				return (this.$data.index - this.$props.itemsToSlide) < 0;
			},

			// boolean for if we're at the last slide
			upperLimit() {
				return (this.$data.index + this.$props.itemsToSlide) > (this.$data.total - 1);
			},
		},

		mounted() {
			// Create draggable instance
			Draggable.create(this.$refs.slider, {
				type: 'x',
				inertia: true,
				dragResistance: 0.25,
				edgeResistance: 0.85,
				lockAxis: true,
				onThrowComplete: this.onComplete,
				onDragStart: this.endAutoPlay,
				zIndexBoost: false,
				maxDuration: 0.6,
				snap: {
					x: v => Math.round(v / this.$data.gridWidth) * this.$data.gridWidth,
				},
			});

			// assign it for easy access
			this.$data.draggable = Draggable.get(this.$refs.slider);

			// begin autoplay
			if (this.$props.autoPlay) this.autoPlayHandler();

			// watch for viewport changes / fires first resize check
			this.watchViewport();
		},

		methods: {
			// defines boundaries relative to viewport, reset slider position
			onResize() {
				const { slides } = this.$refs;
				this.$data.total = slides.length;

				this.$data.gridWidth = slides[0].offsetWidth;
				this.$data.trackWidth = this.$data.gridWidth * (this.$data.total - 1);

				if (this.$data.draggable) {
					this.$data.draggable.applyBounds({
						minX: -this.$data.trackWidth,
						maxX: 0,
					});
				}

				this.setTo(this.$data.index);
			},

			// returns suitable x position based on given index
			x(index) {
				return (index + this.$props.duplicates) * this.$data.gridWidth * -1;
			},

			// transition to a specific slide
			moveTo(i) {
				gsap.to(this.$refs.slider, {
					x: this.x(i),
					onComplete: () => this.onComplete(),
				});
			},

			// move immediately to a specific slide
			setTo(i) {
				gsap.set(this.$refs.slider, {
					x: this.x(i),
				});
			},

			// handles skipping forward or backwards a slide (or as many as specified)
			onSkip(forward, manual) {
				if (manual) this.endAutoPlay();

				const v = this.$props.itemsToSlide;
				const index = this.$data.index + (forward ? v : -v);

				this.moveTo(index);
			},

			// handles autoplay functionality
			autoPlayHandler() {
				this.interval = setInterval(() => {
					if (this.$props.infinite || !this.upperLimit) {
						this.onSkip(true);
					} else if (this.upperLimit) {
						this.moveTo(0);
					}
				}, this.$props.playSpeed);
			},

			// clears autoplay interval
			endAutoPlay() {
				if (this.interval) clearInterval(this.interval);
			},

			// handles application of control's disabled state
			disabilityHandler(forward) {
				if (this.$props.infinite) return false;

				return forward ? this.upperLimit : this.lowerLimit;
			},

			// updates index's resting position after an action
			onComplete() {
				this.$data.draggable.update();
				const v = Math.abs(this.$data.draggable.x) / this.$data.gridWidth;

				if (this.$props.infinite) {
					const index = v - this.$props.duplicates;

					this.$data.index = gsap.utils.wrap(0, this.$props.items.length)(index);
					this.setTo(this.$data.index);
				} else {
					this.$data.index = v;
				}
			},
		},
	};
</script>
