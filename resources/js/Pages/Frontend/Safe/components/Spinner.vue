<template>
    <div class="loader-container">
        <div class="loader arrow">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</template>

<script setup></script>

<style>
.loader-container {
    display: flex;
    gap: 30px;
}

.loader {
    width: 50px;
    height: 50px;
    position: relative;
}

/* Spinner Animation */
.spinner {
    border: 5px solid rgba(0, 0, 0, 0.1);
    border-top: 5px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

/* Bouncing Dots Animation */
.bouncing-dots {
    display: flex;
    justify-content: space-around;
}

.bouncing-dots::before,
.bouncing-dots::after {
    content: '';
    width: 15px;
    height: 15px;
    background-color: #ffffff;
    border-radius: 50%;
    animation: bounce 0.6s infinite alternate;
}

.bouncing-dots::after {
    animation-delay: 0.3s;
}

@keyframes bounce {
    to {
        transform: translateY(-50%);
    }
}

/* Rotating Plane Animation */
.rotating-plane {
    background-color: #ffffff;
    animation: rotatePlane 1.2s infinite ease-in-out;
}

@keyframes rotatePlane {
    0% {
        transform: perspective(120px) rotateX(0deg) rotateY(0deg);
    }

    50% {
        transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
    }

    100% {
        transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    }
}

.arrow {
    display: flex;
    transform: translate(-50%, -50%);
    transform: rotate(90deg);
    cursor: none;
    gap: 10px;
}

.arrow span {
    display: flex;
    border-bottom: 5px solid #ffffff;
    border-right: 5px solid #ffffff;
    animation: animate 2s infinite;
}

.arrow span:nth-child(2) {
    animation-delay: -0.2s;
}

.arrow span:nth-child(3) {
    animation-delay: -0.4s;
}

.arrow span:nth-child(4) {
    animation-delay: -0.8s;
}

.arrow span:nth-child(5) {
    animation-delay: -1.2s;
}

.arrow span:nth-child(6) {
    animation-delay: -1.6s;
}

@keyframes animate {
    0% {
        opacity: 0;
    }

    50% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}
</style>