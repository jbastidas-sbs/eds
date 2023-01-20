<template>
  <div>
    <Head title="Nuevo Proyecto" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/projects">Nuevo</Link>
      <span class="text-indigo-400 font-medium">/</span> Proyecto
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Nombre" />
          <text-input v-model="form.code" :error="form.errors.code" class="pb-8 pr-6 w-full lg:w-1/2" label="Código" />
          <text-input v-model="form.description" :error="form.errors.description" class="pb-8 pr-6 w-full lg:w-1/2" label="Descripción" />
          <select-input id="project_type" v-model="form.project_type_id" :error="form.errors.project_type_id" @change="setProjectableType" class="pb-8 pr-6 w-full lg:w-1/2" label="Tipo de proyecto">
            <option :value="null" />
            <option v-for="projectType in projectTypes" :key="projectType.id" :value="projectType.id">{{ projectType.name }}</option>
          </select-input>
          <select-input v-if="form.project_type_id === 1" v-model="form.projectable_id" :error="form.errors.projectable_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Responsable">
            <option :value="null" />
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.first_name }}</option>
          </select-input>
          <select-input v-if="form.project_type_id === 2" v-model="form.projectable_id" :error="form.errors.projectable_id" class="pb-8 pr-6 w-full lg:w-1/2" label="Responsable">
            <option :value="null" />
            <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{ customer.name }}</option>
          </select-input>
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Guardar Proyecto</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  props: {
    projectTypes: Array,
    users: Array,
    customers: Array,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: '',
        code: '',
        project_type_id: null,
        description: '',
        projectable_id: null,
        projectable_type: '',
      }),
    }
  },
  methods: {
    setProjectableType() {
      const select = document.getElementById('project_type');
      if (select.value == 1) {
        this.form.projectable_type = 'App\\Models\\User'
      }
      else{
        this.form.projectable_type = 'App\\Models\\Customer'
      }
    },
    store() {
      this.form.post('/projects')
    },
  },
}
</script>
