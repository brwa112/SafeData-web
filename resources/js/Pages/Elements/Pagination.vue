<template>
  <div>
    <ul class="flex space-x-2 rtl:space-x-reverse">
      <li>
        <a href="javascript:;" class="text-primary hover:underline">Elements</a>
      </li>
      <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
        <span>Pagination</span>
      </li>
    </ul>
    <div class="pt-5 grid grid-cols-1 xl:grid-cols-2 gap-6">
      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white-light">Default</h5>
        </div>
        <div class="mb-5">
          <div class="flex justify-center flex-col w-full">
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto mb-4">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  First
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  Prev
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-primary border-2 border-primary dark:border-primary dark:text-white-light">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  Next
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  Last
                </button>
              </li>
            </ul>
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  Prev
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-primary border-2 border-primary dark:border-primary dark:text-white-light">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition text-dark hover:text-primary border-2 border-[#e0e6ed] dark:border-[#191e3a] hover:border-primary dark:hover:border-primary dark:text-white-light">
                  Next
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white-light">Solid</h5>
        </div>
        <div class="mb-5">
          <div class="flex justify-center flex-col w-full">
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto mb-4">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  First
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  Prev
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  Next
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  Last
                </button>
              </li>
            </ul>
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  Prev
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  Next
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white-light">With Icons</h5>
        </div>
        <div class="mb-5">
          <div class="flex justify-center flex-col w-full">
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto mb-4">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                    <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                    <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
            </ul>
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white-light">With Icons and Rounded</h5>
        </div>
        <div class="mb-5">
          <div class="flex justify-center flex-col w-full">
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto mb-4">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold p-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                    <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold p-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded-full transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold p-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold p-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                    <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
            </ul>
            <ul class="inline-flex items-center space-x-1 rtl:space-x-reverse m-auto">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold p-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded-full transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold p-2 rounded-full transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="panel">
        <div class="flex items-center justify-between mb-5">
          <h5 class="font-semibold text-lg dark:text-white-light">No Spacing</h5>
        </div>
        <div class="mb-5">
          <div class="flex justify-center flex-col w-full">
            <ul class="inline-flex items-center m-auto mb-4">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold ltr:rounded-l-full rtl:rounded-r-full px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                    <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold ltr:rounded-r-full rtl:rounded-l-full px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                    <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5"
                      stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
            </ul>
            <ul class="inline-flex items-center m-auto">
              <li>
                <button type="button"
                  class="flex justify-center font-semibold ltr:rounded-l-full rtl:rounded-r-full px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  1
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-primary text-white dark:text-white-light dark:bg-primary">
                  2
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  3
                </button>
              </li>
              <li>
                <button type="button"
                  class="flex justify-center font-semibold ltr:rounded-r-full rtl:rounded-l-full px-3.5 py-2 transition bg-white-light text-dark hover:text-white hover:bg-primary dark:text-white-light dark:bg-[#191e3a] dark:hover:bg-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 rtl:rotate-180">
                    <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
</script>
