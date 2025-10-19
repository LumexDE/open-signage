<script setup>
import { computed, onMounted, onUpdated, reactive, useAttrs, watch } from "vue";

const props = defineProps(["page"]);
defineOptions({
    inheritAttrs: false,
});

import Time from "@/Projects/FurcietySchedule/Components/CurrentTime.vue";
//import LogoSVG from "@/Projects/FurcietySchedule/Assets/images/logoEF27e.svg";

let attrs = reactive(useAttrs());

const usableAttributes = computed(() => {
    return {
        ...attrs,
        page: props.page,
        ...props.page.props,
    };
});
</script>

<template>
    <div>
        <!-- animated background -->
        <div
            class="absolute top-0 left-0 z-0 flex items-center justify-center w-screen h-screen text-center"
        >
            <!-- todo: implement -->
        </div>

        <Time hourglass="false" />

        <div class="flex flex-col flex-grow h-screen overflow-auto bg-primary">
            <!-- Main Content -->
            <Transition mode="out-in">
                <component
                    :is="page.resolvedComponent"
                    v-bind="usableAttributes"
                ></component>
            </Transition>
        </div>
    </div>
</template>

<style>
.bounce-enter-active {
    animation: bounce-in 0.5s;
}

.bounce-leave-active {
    animation: bounce-in 0.5s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.25);
    }
    100% {
        transform: scale(1);
    }
}
</style>
