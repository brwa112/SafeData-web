<template>
    <div>
        <vue-particles id="tsparticles" :options="options" />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const options = ref({});

const getOptions = () => {
    return {
        fpsLimit: 120,
        interactivity: {
            events: {
                onClick: {
                    enable: false,
                    mode: 'push'
                },
                onHover: {
                    enable: true,
                    mode: 'grab'
                },
            },
            modes: {
                bubble: {
                    distance: 400,
                    duration: 5,
                    opacity: 0.09,
                    size: 40
                },
                push: {
                    quantity: 5
                },
                repulse: {
                    distance: 600,
                    duration: 0.4
                }
            }
        },
        particles: {
            color: {
                value: '#ffffff'
            },
            links: {
                color: '#ffffff',
                distance: 200,
                enable: true,
                opacity: 0.09,
                width: 1
            },
            move: {
                direction: 'none',
                enable: true,
                outModes: 'bounce',
                random: false,
                speed: 2,
                straight: false
            },
            number: {
                density: {
                    enable: true,
                },
                value: 40
            },
            opacity: {
                value: 0.09
            },
            shape: {
                type: 'circle'
            },
            size: {
                value: { min: 1, max: 5 }
            }
        },
        detectRetina: true
    };
};

onMounted(() => {
    options.value = getOptions();
});
</script>
