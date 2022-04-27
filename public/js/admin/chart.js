(async()=>{
const chart=new Chartisan({
   
    el:'#chart',
    url:urls.diagram,
    hooks:new ChartisanHooks()
    .title('gépek termenként')
       
    .datasets([
        {type:"bar"} 
       
    ])
    .custom(({data,merge})=>{
       
    const dataZoom=[{
        type:"slider",
        
    },
    {
        
        type:"inside",
        
    }
    ];
    return merge(data,{dataZoom});
    })
    
});
const chart2=new Chartisan({
    el:'#chart2',
    url:urls.eszkozok,
    hooks:new ChartisanHooks()
    .title('tipusonkénti gépek')
    .datasets([
        {type:"bar"}
    ])
    .custom(({data,merge})=>{
    const dataZoom=[{
        type:"slider",
        
    },
    {
        type:"inside",
     
    }
    ];
    return merge(data,{dataZoom});
    })
    
});
const chart3=new Chartisan({
    el:'#chart3',
    url:urls.berleteladasok,
    hooks:new ChartisanHooks()
    .title('bérlet eladások')
    .datasets([
        {type:"bar"}
    ])
    .custom(({data,merge})=>{
    const dataZoom=[{
        type:"slider",
        
    },
    {
        type:"inside",
        
    }
    ];
    return merge(data,{dataZoom});
    })
    
});
const chart4=new Chartisan({
    el:'#chart4',
    url:urls.arvaltozasok,
    hooks:new ChartisanHooks()
    .title('árváltozások')
    .datasets([
        {type:"line"}
    ])
    .custom(({data,merge})=>{
    const dataZoom=[{
        type:"slider",
       
    },
    {
        type:"inside",
        
    }
    ];
    return merge(data,{dataZoom});
    })
    
});
const chart5=new Chartisan({
    el:'#chart5',
    url:urls.edzotevekenyseg,
    hooks:new ChartisanHooks()
    .title('edző tevékenységek')
    .datasets([
        {type:"bar"}
    ])
    .custom(({data,merge})=>{
    const dataZoom=[{
        type:"slider",
        
    },
    {
        type:"inside",
      
    }
    ];
    return merge(data,{dataZoom});
    })
    
});


    
       const result= await(await fetch('api/oltozofoglalas/letszam/napi')).json();
        const napokSelect=document.getElementById('napok');

       result.forEach((nap) => {
        const option=document.createElement('option') 
        option.value=nap.napok;
        option.text=`${nap.napok}-${nap.letszam}`;
        napokSelect.appendChild(option);
        
       });
       
        const chart6=new Chartisan({
            el:'#chart6',
            url:`${urls.napiletszam}?napok=${result[0].napok}`,
            hooks:new ChartisanHooks()
           
            .title('napi létszám')
            
                .datasets([
                    {type:"bar"}
                ])
                .custom(({data,merge})=>{
                   
                    const dataZoom=[
                        {
                            type:"slider",
                           
                        },
                        {
                            type:"inside",
                           
                        }
                    ];
                    
                    return merge(data,{dataZoom});
                })
        });

        napokSelect.addEventListener('change',(event)=>{
            console.log("szia")

            const newDate = event.target.value
            chart6.update({
                url: `${urls.napiletszam}?napok=${newDate}`
            });
         })
})();
    
