const { h } = window.hyperapp

export default ({name, w, he}) => h('img', {src: `public/assets/img/${name}.svg`, width: w, height: he})