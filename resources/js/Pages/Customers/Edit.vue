<template>
  <div>
    <Head :title="`${form.name}`" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/customers">Clientes</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="customer.deleted_at" class="mb-6" @restore="restore"> Este cliente se encuentra eliminado. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Nombre" />
          <text-input v-model="form.fiscal_identification" :error="form.errors.fiscal_identification" class="pb-8 pr-6 w-full lg:w-1/2" label="Identificación fiscal" />
          <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Teléfono" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Correo" />
          <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Dirección" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!customer.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Eliminar Cliente</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Actualizar Cliente</loading-button>
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
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    customer: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: this.customer.name,
        fiscal_identification: this.customer.fiscal_identification,
        telephone: this.customer.telephone,
        email: this.customer.email,
        address: this.customer.address,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/customers/${this.customer.id}`)
    },
    destroy() {
      if (confirm('Está seguro que desea eliminar este cliente?')) {
        this.$inertia.delete(`/customers/${this.customer.id}`)
      }
    },
    restore() {
      if (confirm('Está seguro que desea restaurar este cliente?')) {
        this.$inertia.put(`/customers/${this.customer.id}/restore`)
      }
    },
  },
}
</script>
