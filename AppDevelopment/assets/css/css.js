/**
 * File DOC
 * 
 * @Description Estilo CSS do Projeto.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da Documentação de Cabeçalho. Organização e Análise geral das classes utilizadas.
 * 
 */

import { StyleSheet} from 'react-native';
import { Dimensions } from 'react-native';

const css = StyleSheet.create({    

  // ############ Generic Elements
  container:{
    flex:1,
    flexDirection: "column"  ,
    backgroundColor: '#151516' ,    
  } ,

  headerDefault: {
    flexDirection: 'row' ,    
    width: '100%' , 
    minWidth: 100 , 
    minHeight: 100 ,
    backgroundColor: '#151516' ,
  } ,

  // Margins / Paddings
  m_One: { margin: 5 } ,
  m_Two: { margin: 10 } ,
  m_Three: { margin: 15 } ,
  m_Four: { margin: 25 } ,

  // Top - Right - Bottom - Left
  m_OneTop: { marginTop: 5 } ,
  m_TwoTop: { marginTop: 10 } ,
  m_ThreeTop: { marginTop: 15 } ,
  m_FourTop: { marginTop: 25 } ,

  m_OneRight: { marginRight: 5 } ,
  m_TwoRight: { marginRight: 10 } ,
  m_ThreeRight: { marginRight: 15 } ,
  m_FourRight: { marginRight: 25 } ,

  m_OneBottom: { marginBottom: 5 } ,
  m_TwoBottom: { marginBottom: 10 } ,
  m_ThreeBottom: { marginBottom: 15 } ,
  m_FourBottom: { marginBottom: 25 } ,

  m_OneLeft: { marginLeft: 5 } ,
  m_TwoLeft: { marginLeft: 10 } ,
  m_ThreeLeft: { marginLeft: 15 } ,
  m_FourLeft: { marginLeft: 25 } ,

  // Horizonta - Vertical
  m_OneX: { marginHorizontal: 5 } ,
  m_TwoX: { marginHorizontal: 10 } ,
  m_ThreeX: { marginHorizontal: 15 } ,
  m_FourX: { marginHorizontal: 25 } ,

  m_OneY: { marginVertical: 5 } ,
  m_TwoY: { marginVertical: 10 } ,
  m_ThreeY: { marginVertical: 15 } ,
  m_FourY: { marginVertical: 25 } ,

  // Alignment
  centerSelf: { alignSelf: 'center' } ,
  centerChildren: { alignItems: 'center', alignContent: 'center' } ,
  centerVerticaly: { justifyContent: 'center' } ,

  centerText: { textAlign: 'center' } ,

  startHorizontaly: { alignSelf: 'flex-start' } ,
  endtHorizontaly: { alignSelf: 'flex-end' } ,

  // Flex
  rowOrientation: { flexDirection: 'row' , } ,
  rowReverseOrientation: { flexDirection: 'row-reverse' , } ,
  colOrientation: { flexDirection: 'column' , } ,
  colReverseOrientation: { flexDirection: 'column-reverse' , } ,

  flexOne:  { flex: 1 },
  flexTwo:  { flex: 2 },
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

  // Font Size
  size12: { fontSize: 12 } ,
  size14: { fontSize: 14 } ,
  size15: { fontSize: 15 } ,
  size16: { fontSize: 16 } ,
  size18: { fontSize: 18 } ,
  size20: { fontSize: 20 } ,
  size22: { fontSize: 22 } ,
  size24: { fontSize: 24 } ,
  size26: { fontSize: 26 } ,
  size30: { fontSize: 30 } ,

  // Font Family
  fontBebas: { fontFamily: 'BebasNeue' } ,
  fontGhotic: { fontFamily: 'CenturyGothic' , } ,
  fontGhoticB: { fontFamily: 'CenturyGothicB' , } ,

  // Font Colors
  textWhite:    { color: '#ffffff' } ,
  textRed:      { color: '#eb1f36' } ,  
  textBlack:    {color: '#000'} ,
  textLightred: {color: '#e73b4f'} ,
  textBlueLink: {color: '#1cb7e6'} ,
  textLightgray:{color: '#d3d1d1'} ,
  textGray:     {color: '#868484'} ,
  textDeepGray: {color: '#545252'} ,

  // Font Style
  fontBold: { fontWeight: 'bold' } ,
  underlineText: { textDecorationLine: 'underline' } ,
  
  // Default Text's
  titleText:{
    textAlign: 'center' ,
    color:'#FFF' ,
    fontSize: 40 ,
    letterSpacing: 1 ,
  } ,

  // Visual
  hrDefault: {
    borderBottomColor: '#434343',
    borderBottomWidth: 1,
    marginVertical: 15 ,
  } ,

  hrLightGrey: {
    borderBottomColor: '#777676',
    borderBottomWidth: 1,
    marginVertical: 15 ,
  } ,  

  // Buttons
  buttonDefault:{
    backgroundColor: '#eb1f36' ,
    borderRadius: 20 ,
    paddingVertical: 8 ,
    alignSelf: 'center' ,
    alignItems: 'center' ,
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


  // ############ Welcome
  buttonWelcome:{    
    width: '60%',
    backgroundColor: '#eb1f36',
    borderRadius: 50,
    paddingVertical: 13
  } ,


  // ############ SignIn
  loginMsg: {
    color: "#eb1f36",
    display: 'flex' ,
  } ,

  inputDefault:{
    textAlign: 'center' ,
    alignContent: 'center' ,
    height: 50 ,
    borderWidth: 1 ,
    borderColor: '#d3d1d1' ,
    borderRadius: 20 ,
    backgroundColor : "#fff" ,
  } ,

  // ############ Header
  profileImageHeader: {
    width: 60 ,
    height: 60 ,
    borderRadius: 40 ,
    borderWidth: 2 ,
    borderColor: '#eb1f36'
  }

});

export{css};