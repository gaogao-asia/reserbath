import MainContent from './components/MainContent.vue';
import Container from './components/Container.vue';

import Index from './components/reservations/Index.vue'
import Show from './components/reservations/Show.vue'
import Create from './components/reservations/Create.vue'
import Edit from './components/reservations/Edit.vue'

export const routes = [
  {
    path: '/',

    component: Container,

    meta: {
      requiresAuth: true
    },

    children: [
      {
        path: '/',
        component: Index
      },
      {
        path: 'reservations/create',
        component: Create,
      },
      {
        path: 'reservations/:id',
        component: Show,
      },
      {
        path: 'reservations/:id/edit',
        component: Edit,
      },
    ]
  }
]