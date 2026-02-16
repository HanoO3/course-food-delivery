import { usePage } from '@inertiajs/vue3'

export const Can = {
  install: (app) => {
    const can = (permission) => {
      const page = usePage()               
      return page.props.auth?.permissions?.includes(permission) ?? false
    }

    
    app.mixin({
      methods: { can }
    })

   
    app.config.globalProperties.$can = can
  }
}