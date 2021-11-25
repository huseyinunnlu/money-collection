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
            <strong>{{$t('money.table.column.ems')}}</strong>
          </td>
          <td>{{money.emission_id.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.scwpm')}}</strong>
          </td>
          <td>{{money.scwpm_id.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.kuphur')}}</strong>
          </td>
          <td>{{money.kuphur_id.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.serie')}}</strong>
          </td>
          <td>{{money.serie_id.title}}</td>
        </tr>

        <tr>
          <td>
            <strong>{{$t('money.table.column.tertip')}}</strong>
          </td>
          <td>{{money.tertip_id.title}}</td>
        </tr>

        <tr>
          <td>
            <strong>{{$t('money.table.column.printPlace')}}</strong>
          </td>
          <td>{{money.print_place_id.title}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.value')}}</strong>
          </td>
          <td>{{money.value}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.cil')}}</strong>
          </td>
          <td>{{money.cilValue}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.ct')}}</strong>
          </td>
          <td>{{money.ctValue}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.t')}}</strong>
          </td>
          <td>{{money.tValue}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.size')}}</strong>
          </td>
          <td>{{money.size}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.date1')}}</strong>
          </td>
          <td>{{money.tedavulDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.date2')}}</strong>
          </td>
          <td>{{money.lastDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.date3')}}</strong>
          </td>
          <td>{{money.zortedDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.date4')}}</strong>
          </td>
          <td>{{money.timeoutDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.date5')}}</strong>
          </td>
          <td>{{money.expiryDate}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.frontColor')}}</strong>
          </td>
          <td>{{money.frontColor}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.backColor')}}</strong>
          </td>
          <td>{{money.backColor}}</td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.link')}}</strong>
          </td>
          <td>
            <a :href="money.link">Go</a>
          </td>
        </tr>
        
        <tr>
          <td>
            <strong>{{$t('money.table.column.desc')}}</strong>
          </td>
          <td>{{money.desc}}</td>
        </tr>
        

      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props:{
    money:{
      type:Object,
      default(){
        return {}
      }
    }
  }
}
</script>