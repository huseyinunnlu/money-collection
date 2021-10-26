<template>
  <div class="container">
    <div class="money-images d-flex justify-content-center flex-column align-items-center my-4">
      <img :src="money.frontImage" class="mb-4">
      <img :src="money.backImage">
    </div>

    <table class="table-striped table">
      <tbody>
        <tr>
          <td>
            <strong>Emission</strong>
          </td>
          <td>{{money.emission.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>SCWPM</strong>
          </td>
          <td>{{money.scwpm.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Kuphür</strong>
          </td>
          <td>{{money.kuphur.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Serie</strong>
          </td>
          <td>{{money.serie.title}}</td>
        </tr>

        <tr>
          <td>
            <strong>Tertip</strong>
          </td>
          <td>{{money.tertip.title}}</td>
        </tr>

        <tr>
          <td>
            <strong>Print Place</strong>
          </td>
          <td>{{money.printPlace.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Value</strong>
          </td>
          <td>{{money.value}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Çil Value</strong>
          </td>
          <td>{{money.cilValue}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>T Value</strong>
          </td>
          <td>{{money.tValue}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Size</strong>
          </td>
          <td>{{money.size}}mm</td>
        </tr>
        
        <tr>
          <td>
            <strong>Tedavul Date</strong>
          </td>
          <td>{{money.tedavulDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Tedavulden Çekildiği Tarih</strong>
          </td>
          <td>{{money.lastDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Zorunlu Tedavul Süresinin Sonu</strong>
          </td>
          <td>{{money.zortedDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Zaman Aşımı</strong>
          </td>
          <td>{{money.timeoutDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Kıymetini Kaybedeceği Tarih</strong>
          </td>
          <td>{{money.expiryDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Front Color</strong>
          </td>
          <td>{{money.frontColor}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Back Color</strong>
          </td>
          <td>{{money.backColor}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>Link</strong>
          </td>
          <td>
            <a :href="money.link">Go</a>
          </td>
        </tr>
        
        <tr>
          <td>
            <strong>Description</strong>
          </td>
          <td>{{money.desc}}</td>
        </tr>
        

      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props:['money']
}
</script>