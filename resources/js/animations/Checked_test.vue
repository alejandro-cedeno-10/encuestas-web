<template>
  <div id="lottie">
    <lottie-vue-player :src="`https://assets5.lottiefiles.com/packages/lf20_oal9llzz.json`"
                       :theme="options.theme"
                       :player-size="options.playerSize"
                       style="width: 100%; height:100%"
                       :speed="1.5">
    </lottie-vue-player>
  </div>
</template>

<script>
export default {
  name: 'lottie',
  data() {
    return {
      options: {
        minimizable: false,
        playerSize: "standard",
        backgroundColor: '#fff',
        backgroundStyle: 'color',
        theme: {
          controlsView: "standard",
          active: "light",
          light: {
            color: '#3D4852',
            backgroundColor: '#fff',
            opacity: '0.7',
          },
          dark: {
            color: '#fff',
            backgroundColor: '#202020',
            opacity: '0.7',
          }
        }
      }
    }
  }
}
</script>
