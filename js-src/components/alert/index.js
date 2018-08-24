const { h } = window.hyperapp

export default (type='primary', msg) => 
    h('div', {className: `alert alert-${type} push-notification`}, msg)


