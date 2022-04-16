// Setup for setting JQuery as a dollar variable in WordPress.
jQuery(document).ready(function ($) {
  console.log('page-witte')

  // TODO: The auto reload should be toggleable from the plugin template options.
  //  The timeout should be settable as well.
  setTimeout(() => {
    location.reload()
  }, 60000)
})
