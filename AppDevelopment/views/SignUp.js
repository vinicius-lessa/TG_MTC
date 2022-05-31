/**
 * File DOC
 * 
 * @Description Página 'SignIn' para login de usuários. Pode apontar para SignUp ocasionalmente.
 * @ChangeLog 
 *  - Vinícius Lessa - 31/05/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
 * 
 */

import React, { useEffect, useState } from 'react';  // JSX Compilation
import { 
    View ,
    Text ,
    TextInput ,
    TouchableOpacity ,
    SafeAreaView ,
    Alert ,
    ActivityIndicator ,
} from 'react-native'; // Core Components

import HeaderDefault from './components/Header';

import { css } from '../assets/css/css.js'; // Style - css
import * as Animatable from 'react-native-animatable'  // Animation

import api from '../services/api'; // API Sauce

import AsyncStorageLib from '@react-native-async-storage/async-storage'; // AsyncStorage

import { ScrollView } from 'react-native-gesture-handler';  


// Loading Component
const LoadingIcon = () => {
    return (
    <View style={css.container}>
        <View style = { [ css.flexOne, css.rowOrientation, css.centerChildren ] }>
        <View style = { [ css.centerSelf, css.widthAuto ] }>
            <ActivityIndicator size="large" color="#eb1f36" style = { [ css.centerSelf ] } />
        </View>
        </View>
    </View>
    );
};

const SignUp = (props) => {

    // Form
    const [nameInput        , setNameInput]     = useState(null);
    const [emailInput       , setEmailInput]    = useState(null);
    const [passwordInput    , setPasswordInput] = useState(null);
    const [typeInput        , setTypeInput]     = useState(null);

    const [birthdayInput    , setBirthdayInput] = useState(null);
    const [phoneInput       , setPhoneInput]    = useState(null);
    const [zipCodeInput     , setZipCodeInput]  = useState(null);
    
    // Error Msg
    const [errorMessage  , setErrorMessage]     = useState(null);

    // User Logged Data
    const [userEmail        , setUserEmail]     = useState(null);
    const [userProfilePic   , setProfilePic]    = useState(null);
    const [userPass         , setUserPass]      = useState(null);
    const [userId           , setUserID]        = useState(null);
    const [userName         , setUserName]      = useState(null);

    // Loading Bool
    const [isLoading  , setIsLoading]       = useState(false);


    // SignIn Function
    async function signUpUser() {

        console.log("Teste");

        // setIsLoading(true);

        // let tokenUrl = '16663056-351e723be15750d1cc90b4fcd' ;
        // let route  = "/SignIn/index.php";           

        // try {
        //     const response = await api.post(route, 
        //     {
        //         token: tokenUrl, 
        //         userEmail: emailInput, 
        //         userPassword: passwordInput 
        //     }, {
        //         headers: { 'Content-Type': 'multipart/form-data' }
        //     } );            

        //     const emailText     = response.data.data.email ;
        //     const photoUrl      = response.data.data.image_name ;            
        //     const idText        = response.data.data.user_id ;
        //     const nameText      = response.data.data.user_name ;            

        //     await AsyncStorageLib.multiSet([
        //         // ['@MTC:token'           , token],
        //         ['@MTC:userEmail'       , emailText] ,
        //         ['@MTC:userProfilePic'  , photoUrl] ,
        //         ['@MTC:userPassword'    , passwordInput ] ,
        //         ['@MTC:userID'          , idText] ,
        //         ['@MTC:userName'        , nameText] , 
        //     ]);
            
        //     console.log("SignUp com sucesso!!!")

        //     setIsLoading(false);

        //     return props.navigation.navigate('Welcome');

        // } catch(response) {                            
        //     setErrorMessage(response.data.msg);

        //     console.log(response.data);

        //     setIsLoading(false);
        // }        
    }    

    // Similar ao componentDidMount e componentDidUpdate: 
    useEffect( async () => {
        // Form Values
        // console.log(emailInput);
        // console.log(passwordInput);

        // const token         = await AsyncStorageLib.getItem('@MTC:token');
        const userEmailSession      = await AsyncStorageLib.getItem('@MTC:userEmail');
        const userProfilePicSession = await AsyncStorageLib.getItem('@MTC:userProfilePic');
        const userPasswordSession   = await AsyncStorageLib.getItem('@MTC:userPassword');
        const userIDSession         = await AsyncStorageLib.getItem('@MTC:userID');
        const userNameSession       = await AsyncStorageLib.getItem('@MTC:userName');        

        if ( userEmailSession && userProfilePicSession && userPasswordSession && userIDSession && userNameSession )            
            setUserEmail(userEmailSession);
            setProfilePic(userProfilePicSession);
            setUserPass(userPasswordSession);
            setUserID(userIDSession);
            setUserName(userNameSession);
            
    });

    return (
        <SafeAreaView style={css.container}>
            <ScrollView>            
            
                {/* Header */}
                <HeaderDefault 
                    title="Cadastrar"                
                    userName={null}
                    userPhotoURL={null}
                    navigation={props.navigation}
                    isLoggedUser={false}
                    hideRightIcon={true}
                />
                
                {isLoading && <LoadingIcon />}

                {/* User Info */}
                {/* <View style={{ color: 'white', fontSize: 20 }}>
                    <Text style={{ color: 'white', fontSize: 20 }}>E-mail {userEmail}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>Url do Perfil: {userProfilePic}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>Senha: {userPass}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>ID: {userId}</Text>
                    <Text style={{ color: 'white', fontSize: 20 }}>Nome: {userName}</Text>
                </View> */}

                {/* Header */}
                <View style={ [ css.centerVerticaly, { height: 50 } ]}>
                    <View style={css.centerVerticaly}>
                        <Animatable.View animation="fadeInLeft" delay={300}>
                            <Text style={ [ 
                                css.textLightgray, 
                                css.centerSelf ,
                                css.m_FourTop
                            ]}>
                            Preencha os dados abaixo para se Cadastrar:
                            </Text>
                        </Animatable.View>
                    </View>
                </View>            
                
                {/* Form */}
                <View style={ [ css.flexThree, css.m_FourBottom ]}>
                    <Animatable.View animation="fadeInUp" style={ [ css.m_Three ]}>                    
                                            
                        {/* Log Messages */}
                        { !!errorMessage && 
                            <View>
                                <Text style={ [ css.loginMsg, css.size16, css.centerSelf ]}>
                                    {errorMessage}
                                </Text>
                            </View>
                        }                    

                        {/* Inputs */}
                        <View>
                            <View>
                                <TextInput
                                    textContentType='name'                                    
                                    placeholder="Nome"
                                    maxLength={25}                                    
                                    style={ [ css.inputDefault, css.m_Three ] }
                                    onChangeText={text=>setNameInput(text)}
                                    />
                                <TextInput
                                    textContentType='emailAddress'
                                    placeholder="E-mail"
                                    keyboardType='email-address'
                                    maxLength={25}
                                    style={ [ css.inputDefault, css.m_Three ] }
                                    onChangeText={text=>setEmailInput(text)}
                                />
                                <TextInput
                                    textContentType='password'                                
                                    placeholder="Senha"
                                    style={ [ css.inputDefault, css.m_Three ] }
                                    secureTextEntry={true}
                                    maxLength={25}
                                    onChangeText={text=>setPasswordInput(text)}
                                />
                                <TextInput
                                    placeholder="Tipo Pessoa"                                    
                                    style={ [ css.inputDefault, css.m_Three ] }
                                    onChangeText={text=>setTypeInput(text)}
                                />
                            </View>

                            <View style = { css.m_FourTop }>
                                <Text style = { [ css.textWhite, css.size26, css.fontBebas, css.centerSelf ] }>
                                    Outras Informações
                                </Text>
                            </View>

                            <View style = { css.m_TwoTop }>
                                <TextInput                                    
                                    placeholder="Data de Nascimento"
                                    style={ [ css.inputDefault, css.m_Three ] }
                                    onChangeText={text=>setBirthdayInput(text)}
                                    />
                                <TextInput
                                    textContentType='telephoneNumber'
                                    placeholder="Telefone"
                                    maxLength={15}
                                    style={ [ css.inputDefault, css.m_Three ] }
                                    onChangeText={text=>setPhoneInput(text)}
                                />
                                <TextInput
                                    textContentType='postalCode'
                                    placeholder="CEP"
                                    maxLength={8}
                                    style={ [ css.inputDefault, css.m_Three ] }
                                    onChangeText={text=>setZipCodeInput(text)}
                                />
                            </View>                            
                        </View>

                        {/* Bottom of Page */}
                        <View>
                            <View style = { [ css.m_ThreeY, css.p_ThreeY ] }>
                                <TouchableOpacity
                                    style={ [css.buttonDefault, { width: '55%' }] }
                                    onPress={()=>signUpUser()}
                                >
                                    <Text style={ [css.size18, css.textWhite, css.fontBold] }>
                                        CRIAR !
                                    </Text>
                                </TouchableOpacity>
                            </View>
                        
                            <View style = { [ css.m_FourTop ] }>
                                <TouchableOpacity
                                    onPress={()=>props.navigation.navigate('SignIn')}
                                >
                                    <Text style={ [css.textWhite, css.centerText] }>
                                    Já possui uma Conta?  <Text style={ [ css.fontBold, css.underlineText ] }>Entre</Text>
                                    </Text>
                                </TouchableOpacity>
                            </View>
                        </View>
                
                    </Animatable.View>

                </View>
            </ScrollView>
        </SafeAreaView>
    );
}

export default SignUp;