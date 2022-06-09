/**
 * File DOC
 * 
 * @Description Estilo CSS do Projeto.
 * @ChangeLog 
 *  - Vinícius Lessa - 18/05/2022: Inclusão da Documentação de Cabeçalho. Organização e Análise geral das classes utilizadas.
 *  - Vinícius Lessa - 01/05/2022: Adição da Constante '' referente ao estile aplicado para os "Select Inputs" do projeto.
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

  headerNoDrawer: {
    flexDirection: 'row' ,
    width: '100%' ,
    minWidth: 100 ,
    minHeight: 65 ,
    backgroundColor: '#151516' ,    
    borderBottomColor: '#343434',
    borderBottomWidth: 1,    
  } ,

  // Margins / Paddings
  m_One: { margin: 5 } ,
  m_Two: { margin: 10 } ,
  m_Three: { margin: 15 } ,
  m_Four: { margin: 25 } ,

  p_One: { padding: 5 } ,
  p_Two: { padding: 10 } ,
  p_Three: { padding: 15 } ,
  p_Four: { padding: 25 } ,

  // Top
  m_OneTop: { marginTop: 5 } ,
  m_TwoTop: { marginTop: 10 } ,
  m_ThreeTop: { marginTop: 15 } ,
  m_FourTop: { marginTop: 25 } ,

  p_OneTop: { paddingTop: 5 } ,
  p_TwoTop: { paddingTop: 10 } ,
  p_ThreeTop: { paddingTop: 15 } ,
  p_FourTop: { paddingTop: 25 } ,

  // Right
  m_OneRight: { marginRight: 5 } ,
  m_TwoRight: { marginRight: 10 } ,
  m_ThreeRight: { marginRight: 15 } ,
  m_FourRight: { marginRight: 25 } ,

  p_OneRight: { paddingRight: 5 } ,
  p_TwoRight: { paddingRight: 10 } ,
  p_ThreeRight: { paddingRight: 15 } ,
  p_FourRight: { paddingRight: 25 } ,

  // Bottom
  m_OneBottom: { marginBottom: 5 } ,
  m_TwoBottom: { marginBottom: 10 } ,
  m_ThreeBottom: { marginBottom: 15 } ,
  m_FourBottom: { marginBottom: 25 } ,

  p_OneBottom: { paddingBottom: 5 } ,
  p_TwoBottom: { paddingBottom: 10 } ,
  p_ThreeBottom: { paddingBottom: 15 } ,
  p_FourBottom: { paddingBottom: 25 } ,  

  // Left
  m_OneLeft: { marginLeft: 5 } ,
  m_TwoLeft: { marginLeft: 10 } ,
  m_ThreeLeft: { marginLeft: 15 } ,
  m_FourLeft: { marginLeft: 25 } ,

  p_OneLeft: { paddingLeft: 5 } ,
  p_TwoLeft: { paddingLeft: 10 } ,
  p_ThreeLeft: { paddingLeft: 15 } ,
  p_FourLeft: { paddingLeft: 25 } ,

  // Horizonta - Vertical
  m_OneX: { marginHorizontal: 5 } ,
  m_TwoX: { marginHorizontal: 10 } ,
  m_ThreeX: { marginHorizontal: 15 } ,
  m_FourX: { marginHorizontal: 25 } ,

  p_OneX: { paddingHorizontal: 5 } ,
  p_TwoX: { paddingHorizontal: 10 } ,
  p_ThreeX: { paddingHorizontal: 15 } ,
  p_FourX: { paddingHorizontal: 25 } ,  

  m_OneY: { marginVertical: 5 } ,
  m_TwoY: { marginVertical: 10 } ,
  m_ThreeY: { marginVertical: 15 } ,
  m_FourY: { marginVertical: 25 } ,

  p_OneY: { paddingVertical: 5 } ,
  p_TwoY: { paddingVertical: 10 } ,
  p_ThreeY: { paddingVertical: 15 } ,
  p_FourY: { paddingVertical: 25 } ,    

  // Alignment
  centerSelf: { alignSelf: 'center' } ,
  centerChildren: { alignItems: 'center', alignContent: 'center' } ,
  centerVerticaly: { justifyContent: 'center' } ,

  // Text
  centerText: { textAlign: 'center' } ,
  justifyText: { textAlign: 'justify' } ,

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
  size10: { fontSize: 10 } ,
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
  size35: { fontSize: 35 } ,

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
  fontNormal: { fontWeight: 'normal' } ,  
  underlineText: { textDecorationLine: 'underline' } ,
  
  // Default Text's
  titleText:{
    textAlign: 'center' ,
    color:'#FFF' ,
    fontSize: 40 ,
    letterSpacing: 1 ,
  } ,

  headerNavText:{
    textAlign: 'center' ,
    color:'#FFF' ,
    fontSize: 30 ,
    letterSpacing: 1 ,
  } ,

  // Inputs
  inputDefault:{
    textAlign: 'center' ,
    alignContent: 'center' ,
    height: 50 ,
    borderWidth: 1 ,
    borderColor: '#d3d1d1' ,
    borderRadius: 20 ,
    backgroundColor : "#fff" ,
  } ,

  inputTextArea: (isFocused=false) => ({
    textAlign: (isFocused ? 'left' : 'center') ,    
    textAlignVertical: (isFocused ? 'top' : 'center') ,
    borderWidth: 1 ,
    borderColor: '#d3d1d1' ,
    borderRadius: 20 ,
    backgroundColor : "#fff" ,
    height:100 ,    
  }) ,

  // Visual
  hrDefault: {
    borderBottomColor: '#434343',
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
    width: '50%',
    backgroundColor: '#eb1f36',
    borderRadius: 50,
    paddingVertical: 10
  } ,


  // ############ SignIn
  loginMsg: {
    color: "#eb1f36",
    display: 'flex' ,
  } ,

  // ############ Header
  profileImageHeader: {
    width: 60 ,
    height: 60 ,
    borderRadius: 40 ,
    borderWidth: 2 ,
    borderColor: '#eb1f36'
  } ,

  // ############ SideBar
  profileImageSideBar: {
    width: 100 ,
    height: 100 ,
    borderRadius: 50 ,
    borderWidth: 2 ,
    borderColor: '#eb1f36'
  } ,

  // ############ NewTrade Post

  // ############ Trade Post Detailed
  imgDetailedRow: {
    width: '100%' ,
    height: 270 ,
    marginVertical: 5 ,
    padding: 5 ,    
    alignItems: 'center' ,
  } ,

  tpDetailedImgBox: {
    width: '100%' ,
    height: '100%' ,
    borderRadius: 10 ,
    backgroundColor: '#adadae3a' ,    
  } ,

  // ############ UserProfile
  profileImage: {
    width: 250 ,
    height: 250 ,
    borderRadius: 125 ,
  } ,

  // ############ Chat List
  profileImage: {
    width: 250 ,
    height: 250 ,
    borderRadius: 125 ,
  } ,
    
  chatList: {
    backgroundColor: '#383a3b' ,
    margin: 6 ,
    padding: 5 ,
    borderRadius: 5 ,    
  } ,

  chatListRow: {    
    marginVertical: 5 ,
    padding: 5 ,
    height: 70 ,
    width: '100%' ,
    flexDirection: 'row' ,
    alignItems: 'center' ,
    backgroundColor: '#151516' ,
    borderRadius: 5 ,
  } ,

  chatListImgBox: {
    width: '25%' ,
    height: '100%' ,
    borderRadius: 10 ,
    backgroundColor: '#adadae3a' ,
  } ,

  chatListDescBox: {
    width: '75%' ,
    height: '100%' ,     
  } ,

  hrChatList: {
    borderBottomColor: '#2b2a2a',
    borderBottomWidth: .6,
    marginVertical: 8,
  } ,

  // ############ Chat Messages
  chatMessageBox: {
    backgroundColor: '#383a3b' ,
    margin: 5 ,
    borderRadius: 10 ,
  } ,

  hrChatHeader: {
    borderBottomColor: '#2b2a2a',
    borderBottomWidth: .6,
    marginVertical: 0,
  } ,

  chatImgBox: {
    width: '32%' ,
    height: '100%' ,
    borderRadius: 10 ,
    backgroundColor: '#adadae3a' ,
  } ,

  chatDescriptionBox: {
    width: '68%' ,
    height: '100%' ,
    paddingStart: 10 ,
    paddingEnd: 5 ,    
  } ,

  selfMessageBox: {
    paddingHorizontal: 5 ,
    paddingVertical: 8 ,
    borderRadius: 5 ,
    marginVertical: 10,
    marginHorizontal: 5,
    width: '80%' ,
    alignSelf: 'flex-end' ,
    backgroundColor: '#542020' ,
  } ,

  userTwoMessageBox: {
    padding: 5 ,
    borderRadius: 5 ,
    marginVertical: 10,
    marginHorizontal: 5,
    width: '80%'
  } ,

  inputChatMessage:{
    textAlign: 'left' ,
    paddingHorizontal: 5 ,
    color: '#000' ,
    height: '90%' ,
    borderWidth: .8 ,    
    borderRadius: 10 ,
    backgroundColor : "#fff" ,
  } ,

});

// Especific Style used whitin "SignUp" and "NewTradePost" screen's
const pickerSelectStyles = StyleSheet.create({
  inputIOS: {
    color: '#000',    
    paddingHorizontal: 10,
    paddingVertical: 8,
    textAlign: 'center' ,
    alignContent: 'center' ,
    height: 50 ,
    borderWidth: 1 ,
    borderColor: '#d3d1d1' ,
    borderRadius: 20 ,
    backgroundColor : "#fff" ,    
  } ,
  inputAndroid: {
    color: '#000',    
    paddingHorizontal: 10,
    paddingVertical: 8,
    textAlign: 'center' ,
    alignContent: 'center' ,
    height: 50 ,
    borderWidth: 1 ,
    borderColor: '#d3d1d1' ,
    borderRadius: 20 ,
    backgroundColor : "#fff" ,    
  } ,
});

export{ css, pickerSelectStyles };