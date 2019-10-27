import MainContent from './components/MainContent.vue';
import Container from './components/Container.vue';

import Index from './components/reservations/Index.vue'
import Show from './components/reservations/Show.vue'
import Create from './components/reservations/Create.vue'
import Edit from './components/reservations/Edit.vue'

import PostIndex from './components/posts/Index.vue'
import PostShow from './components/posts/Show.vue'
import PostCreate from './components/posts/Create.vue'
import PostEdit from './components/posts/Edit.vue'

import RoomIndex from './components/rooms/Index.vue'
import RoomShow from './components/rooms/Show.vue'
import RoomCreate from './components/rooms/Create.vue'

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
      {
        path: '/posts',
        component: PostIndex
      },
      {
        path: 'posts/create',
        component: PostCreate,
      },
      {
        path: 'posts/:id',
        component: PostShow,
      },
      {
        path: 'posts/:id/edit',
        component: PostEdit,
      },

      {
        path: 'rooms',
        component: RoomIndex,
      },
      {
        path: 'rooms/create',
        component: RoomCreate,
      },
      {
        path: 'rooms/:id',
        component: RoomShow,
      },
    ]
  }
]