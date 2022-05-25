/**
 * File DOC
 * 
 * @Description Estilo CSS do Projeto.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da Documentação de Cabeçalho. Organização e Análise geral das classes utilizadas.
 * 
 */

import { StyleSheet} from 'react-native';


const css = StyleSheet.create({    

  // ############ Generic Elements
  container:{
    flex:1,
    flexDirection: "column" ,
    backgroundColor: '#151516'
  } ,

  // Alignment
  centerSelf: { alignSelf: 'center' } ,
  centerChildren: { alignItems: 'center' } ,
  centerVerticaly: { justifyContent: 'center' } ,

  startHorizontaly: { alignSelf: 'flex-start' } ,
  endtHorizontaly: { alignSelf: 'flex-end' } ,

  // Flex
  rowOrientation: { flexDirection: 'row' , } ,
  rowReverseOrientation: { flexDirection: 'row-reverse' , } ,
  colOrientation: { flexDirection: 'column' , } ,
  colReverseOrientation: { flexDirection: 'column-reverse' , } ,

  flexOne:{ flex: 1 },
  flexTwo:{ flex: 2 },
  flexThree:{ flex: 3 },

  widthAuto: { width: '100%' , } ,  

  // Background Colors
  bkGray:       { backgroundColor: '#1C2124' } ,
  bkLightgray:  { backgroundColor: '#5e5f60' } ,  
  bkRed:        { backgroundColor: '#eb1f36' } ,
  bkWhite:      { backgroundColor: '#edebeb' } ,
  bkYellow:     { backgroundColor: '#ccd304' } , 
  bkOrange:     { backgroundColor: '#eb8d0b' } ,
  bkBlue:       { backgroundColor: '#177bd9' } ,
  bkPurple:     { backgroundColor: '#6f1fc0' } ,
  bkGreen:      { backgroundColor: '#29c418' } ,
  bkChat:       { backgroundColor: '#111415' } ,

  // Fonts
  size12: { fontSize: 12 } ,
  size14: { fontSize: 14 } ,
  size15: { fontSize: 15 } ,
  size16: { fontSize: 16 } ,
  size18: { fontSize: 18 } ,
  size20: { fontSize: 20 } ,
  size22: { fontSize: 22 } ,

  fontBebas: { fontFamily: 'BebasNeue' } ,
  fontGhotic: { fontFamily: 'CenturyGothic' , } ,

  colorWhite: { color: 'white' } ,
  colorRed: { color: '#eb1f36' } ,  

  fontBold: { fontWeight: 'bold' } ,

  titleText:{    
    textAlign: 'center',
    color:'#FFF',
    fontSize: 40,
  } ,

  // Visual
  hrDefault: {
    borderBottomColor: '#434343',
    borderBottomWidth: 1,
    marginVertical: 15 ,
  } ,

  loadingCircle: {        
  } ,

  // ############ TradePosts.js
  tradePostRow: {
    width: '100%' ,
    height: 150 ,
    marginVertical: 5 ,
    padding: 5 ,    
    alignItems: 'center' ,
    // backgroundColor: "steelblue",
  } ,

  tpImgBox: {
    width: '40%' ,
    height: '100%' ,
    borderRadius: 10 ,
    backgroundColor: '#adadae3a' ,    
  } ,

  imgDefault: {
    width: '100%' ,
    height: '100%' ,    
  } ,  

  tpDescriptionBox: {
    width: '60%' ,
    height: '100%' ,
    paddingStart: 10 ,
    paddingEnd: 5 ,
    // backgroundColor: 'purple'
  } ,

  tradePostTitle:{    
    fontSize: 18 ,
    color:'#fff'    
  } ,

  tpInfoBox: {
    paddingVertical: 5 ,
    // backgroundColor: 'darkorange' ,
  } ,

  buttonDefault:{
    backgroundColor: '#eb1f36' ,
    borderRadius: 20 ,
    paddingVertical: 8 ,
    alignSelf: 'center' ,
    alignItems: 'center' ,
  } ,


  // ############ Welcome
  buttonWelcome:{    
    width: '60%',
    backgroundColor: 'red',
    borderRadius: 50,
    paddingVertical: 13
  } ,    


  // ############ ************************************************************* ANALISAR
  // ############ Generic Elements  

  // ############ Welcome    

  title:{
    fontSize: 24,
    fontWeight: 'bold',
    marginTop: 28,
    marginBottom: 12,
  },  

  // ############ TradePosts.js

  textped:{
    color:'gray',
    fontSize: 13,
    position:'absolute',
    left:163,
    top:145  
  } ,

  stats1:{
    color:'red',
    fontSize: 13,
    position:'absolute',
    left:100,
    top:165,  
  } ,

  statsS1:{
    color:'gray',
    fontSize: 13,
    position:'absolute',
    left:143,
    top:165 
  },
  preco1:{
    color:'white',
    fontSize: 20,
    position:'absolute',
    left:100,
    top:190 
  },

  imganuncio2:{
    position:'absolute',
    bottom:410,
    left:300,
  },
  anuncio2T:{
    fontSize: 20,
    color:'#FFF',
    position:'absolute',
    right:185,
    top:275
  },
  anuncio2C:{
    fontSize: 13,
    color:'red',
    position:'absolute',
    right:345,
    top:305  
  },
  textbai:{
    color:'gray',
    fontSize: 13,
    position:'absolute',
    right:239,
    top:305  
  },
  stats2:{
    color:'red',
    fontSize: 13,
    position:'absolute',
    right:363,
    top:330,  
  },
  statsU2:{
    color:'gray',
    fontSize: 13,
    position:'absolute',
    right:320,
    top:330,
  },
  preco2:{
    color:'white',
    fontSize: 20,
    position:'absolute',
    right:135,
    top:355 
  },
  button2:{
    position: 'absolute',
    backgroundColor: 'red',
    borderRadius: 50,
    paddingVertical: 8,
    width: '35%',
    alignSelf: 'center',
    left: '2%',
    bottom: '50%',
    alignItems: 'center',
  },
  buttonText2:{
    fontSize: 18,
    color: '#FFF',
    fontWeight: 'bold'
  },
  imganuncio3:{
    position:'absolute',
    bottom:210,
    right:300,
  },
  anuncio3T:{
    fontSize: 20,
    color:'#FFF',
    position:'absolute',
    left:120,
    top:475
  },
  anuncio3C:{
    fontSize: 13,
    color:'red',
    position:'absolute',
    left:121,
    top:505  
  },
  textgui:{
    color:'gray',
    fontSize: 13,
    position:'absolute',
    left:185,
    top:505  
  },
  stats3:{
    color:'red',
    fontSize: 13,
    position:'absolute',
    left:121,
    top:530,  
  },
  statsU3:{
    color:'gray',
    fontSize: 13,
    position:'absolute',
    left:165,
    top:530,
  },
  preco3:{
    color:'white',
    fontSize: 20,
    position:'absolute',
    left:120,
    top:555 
  },
  button3:{
    position: 'absolute',
    backgroundColor: 'red',
    borderRadius: 50,
    paddingVertical: 8,
    width: '35%',
    alignSelf: 'center',
    right: '5%',
    bottom: '25%',
    alignItems: 'center',
  },
  buttonText3:{
    fontSize: 18,
    color: '#FFF',
    fontWeight: 'bold'
  },

});

export{css};