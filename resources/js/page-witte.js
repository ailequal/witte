// Setup for setting JQuery as a dollar variable in WordPress.
jQuery(document).ready(function ($) {
  console.log('page-witte')

  const search = new URLSearchParams(window.location.search)
  if ('1' === search.get('reload')) {
    // TODO: The timeout should be settable from the plugin options.
    setTimeout(() => {
      location.reload()
    }, 60000)
  }
})
