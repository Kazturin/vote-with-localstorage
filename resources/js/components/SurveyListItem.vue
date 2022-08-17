<template>
  <div class="relative poll-view rounded-lg"  ref="printcontent"
       :class="[result||voted?'bg-gradient-to-r from-lime-400 to-lime-600':'bg-gradient-to-r from-yellow-400 to-yellow-600']">
    <div class="poll-view__title relative h-48 rounded-t-lg overflow-hidden border">
      <img v-show="survey.image_url"
        :src="survey.image_url"
        :alt="survey.title"
        class="block opacity-70 mx-auto w-full h-full object-cover"
      />
      <div class="absolute w-full px-10 left-2/4 top-2/4 transform -translate-x-1/2 -translate-y-1/2 text-lg text-white">{{survey.title}}</div>
    </div>

      <div v-if="result || voted" class="poll-view__results p-4">
          <div class="text-gray-500 text-sm">Публичный опрос - {{survey.category}}</div>
<!--          <div class="text-gray-800 text-lg border-gray-500 border-b">-->
<!--              {{survey.title}}-->
<!--          </div>-->
        <div class="my-2">Результат:</div>
        <div class="result" v-for="(answer, index) in survey.answers" :key="index">
          <div class="flex items-center">
            <div class="flex-1 relative mb-2 bar rounded-lg text-white border-lime-600 border bg-lime-500">
              <div class="relative inset-0 transparent z-10">
                <div class="p-2">
                  {{ answer.answer }}
                </div>
              </div>
              <div class="absolute inset-0" :style="{width: calculatePercent(answer.count) + '%'}" :class="{'bg-lime-600' : answer.count>0}">

              </div>
            </div>
            <span class="p-2 w-14">{{totalVotes>0 ? calculatePercent(answer.count) : null}}%</span>
          </div>
        </div>
        <div>Голос:{{ totalVotes }}</div>
      </div>
    <div v-else class="poll-view__inner p-4 rounded-b-lg">
      <div class="text-gray-500 text-sm">Публичный опрос - {{survey.category}}</div>
<!--        <div class="text-gray-800 text-lg border-gray-500 border-b">-->
<!--            {{survey.title}}-->
<!--        </div>-->
      <div class="poll-view__help py-2">
        <span>Выберите ответ:</span>
      </div>
      <div class="poll-view__votes">
        <div v-for="(answer, index) in survey.answers" :key="answer.id" class="answer">
<!--          <label class="checkbox">{{ answer.answer }}-->
<!--            <input type="checkbox" v-model="poll.answers[index].voted">-->
<!--            <span class="checkmark"></span>-->
<!--          </label>-->
          <div class="p-2 my-2 rounded-lg text-white cursor-pointer bg-yellow-600"  @click="vote(answer.id,index);voting=true">
            {{ answer.answer }}
          </div>
        </div>
      </div>
<!--      <div class="poll-view__submit">-->
<!--        <button @click="vote">Vote</button>-->
<!--      </div>-->
    </div>
      <div class="flex items-center justify-end p-2">
          <button @click="download" class="border-lime-600 border-r px-2">
              <download-icon class="text-sky-600 h-5 w-5"/>
          </button>
          <ul class="flex">
              <li>
                  <share-link
                      :params="{u: `https://votekzfree.tk/survey/${survey.id}`}"
                      socialUrl="https://www.facebook.com/sharer/sharer.php"
                      svg-path="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/>
              </li>
              <li>
                <whatsup-share :params="{text: `https://votekzfree.tk/survey/${survey.id}`}"/>
               </li>
              <li>
                  <share-link
                      :params="{url: `https://votekzfree.tk/survey/${survey.id}`}"
                      socialUrl="https://t.me/share/url"
                      svg-path="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"/>
              </li>
          </ul>
          <TButton v-if="edit" @click="$emit('delete', survey)" circle link color="red">
              <TrashIcon class="w-5 h-5" />
          </TButton>
      </div>

    <Transition name="fade">
      <div v-if="success" class="poll-view__info absolute inset-0 z-50 rounded-lg bg-lime-500" >
        <div class="absolute left-2/4 top-2/4 transform -translate-x-1/2 -translate-y-1/2 text-white  text-3xl text-center">
          Спасибо за ваш голос!
        </div>
        <!--        <div v-if="success === false">Error</div>-->
      </div>
    </Transition>
  </div>

</template>

<script>
import TButton from "./core/TButton.vue";
import { TrashIcon,DownloadIcon } from '@heroicons/vue/solid'
import axios from 'axios'
import store from "../store";
import ShareLink from "./ShareLink.vue";
import WhatsupShare from "./share/WhatsupShare.vue";
import html2canvas from 'html2canvas';

export default {
  name: "poll-view",
  props: {
    survey:{
      type: Object
    },
    saveVoteUrl: {
      type: String
    },
    userIp: {
      type: String
    },
    voted: {
      type: Boolean,
      default: false
    },
    edit: {
      type: Boolean,
      default: false
    },
  },
  created() {
    if (this.voted) {
      this.result=true;
    }
    this.calculateTotalVotes();
  },
  data() {
    return {
      poll: {
      },
      colors:
        {
          'bgLight': 'bg-'+this.survey.color+'-500',
          'bgStrong': 'bg-'+this.survey.color+'-600',
          'border': 'border-'+this.survey.color+'-700',
        }
      ,
      totalVotes: 0,
      result: false,
      success: null,
      isValid: true,
      voting:false,
      baseUrl: window.location.origin,

    };
  },
  methods: {
    vote(answer_id,index) {
          store.dispatch("sendVote", {id:answer_id}).then((res) => {
            this.survey.answers[index] = res.data.data;
            this.alert(true);
            this.calculateTotalVotes();
            console.log(this.survey.id);
              this.$emit('voting',this.survey.id)
            // store.commit("notify", {
            //   type: "success",
            //   message: "Успешно!",
            // });
          })
            .catch((error) => {
            this.alert(false)
              console.log(error)
            error.request.res.destroy()
          });

    //  }
    },
     alert(success) {
      this.success = success

      setTimeout(() => {
        this.result = success
        this.success = null
      }, 2000)
    },
    calculatePercent(votes) {
      // if (this.voting) {
      //       votes += 1;
      // }
      console.log(votes);
      return parseInt(10000 * votes / this.totalVotes) / 100;
    },
    calculateTotalVotes() {
        console.log(this.survey)
      this.totalVotes = 0;
      this.survey.answers.forEach((answer) => {
        this.totalVotes += answer.count
        // if (this.voting) {
        //   this.totalVotes += 1;
        // }
      });
      console.log('total votes='+this.totalVotes);
    },
      async download() {
          console.log("printing..");
          const el = this.$refs.printcontent;

          const options = {
              type: "dataURL"
          };
          const printCanvas = await html2canvas(el, options);

          const link = document.createElement("a");
          link.setAttribute("download", "download.png");
          link.setAttribute(
              "href",
              printCanvas
                  .toDataURL("image/png")
                  .replace("image/png", "image/octet-stream")
          );
          link.click();

          console.log("done");
      }
  },

  components:{
    TButton,
    TrashIcon,
    DownloadIcon,
    ShareLink,
    WhatsupShare,
  }
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease-in
}

.fade-enter-from,
.fade-enter,
.fade-leave-to
  /* .fade-leave-active in <2.1.8 */
{
  opacity: 0;
}
</style>
