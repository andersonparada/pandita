<template>
  <Head title="Welcome" />

  <div>
    <div class="container-fluid fixed-top p-4">
      <div class="col-12">
        <div v-if="canLogin" class="d-flex justify-content-end">
          <div>
            <Link
              v-if="$page.props.user"
              :href="route('productos')"
              class="text-muted"
            >
              Inicio
            </Link>

            <template v-else>
              <Link :href="route('login')" class="text-muted"> Log in </Link>

              <Link
                v-if="canRegister"
                :href="route('register')"
                class="ms-4 text-muted"
              >
                Register
              </Link>
            </template>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid my-5 pt-5 px-5">
      <div class="row justify-content-center px-4">
        <div class="col-md-12 col-lg-9">
          <div class="card shadow-sm">
            <div class="row">
              <div class="col-md-6 pe-0">
                <div class="card-body border-right border-bottom p-3 h-100">
                  <div class="d-flex flex-row bd-highlight pt-2">
                    <div>
                      <svg
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        class="text-muted"
                        width="32"
                      >
                        <path
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                        ></path>
                      </svg>
                    </div>
                    <div class="ps-3">
                      <div class="mb-2">
                        <a
                          href="https://laravel.com/docs"
                          class="h5 font-weight-bolder text-dark"
                          >We Are Pandita</a
                        >
                      </div>
                      <p class="text-muted small">
                        There are many variations of passages of Lorem Ipsum
                        available, but the majority have suffered alteration in
                        some form, by injected humour, or randomised words which
                        don't look even slightly believable. If you are going to
                        use a passage of Lorem Ipsum, you need to be sure there
                        isn't anything embarrassing hidden in the middle of
                        text. All
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    Link,
  },

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
});
</script>
