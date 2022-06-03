/**
 * File DOC
 * 
 * @Description Página 'NewTradePost' onde um usuário (já logado) poderá incluir um Novo anúncio ao sistema.
 * @ChangeLog 
 *  - Vinícius Lessa - 31/05/2022: Criação da documentação de Cabeçalho e Mudanças iniciais na estrutura e Estilo da página.
 *  - Vinícius Lessa - 01/05/2022: Continução da criação do Formulário, diversos avanços visuais e funcionas, inclusão de 3 novos pacotes para os Inputs do Tipo SELECT e RADIO, bem como para user máscara no campo "Valor do Item".
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

import { css, pickerSelectStyles } from '../assets/css/css.js'; // Style - css
import * as Animatable from 'react-native-animatable'  // Animation

// API Sauce
import api from '../services/api';

// AsyncStorage
import AsyncStorageLib from '@react-native-async-storage/async-storage';

import { ScrollView } from 'react-native-gesture-handler';

// Icons
import { Entypo } from '@expo/vector-icons'; 

// Form Features
import RNPickerSelect from 'react-native-picker-select';
import RadioForm, {RadioButton, RadioButtonInput, RadioButtonLabel} from 'react-native-simple-radio-button';
import MaskInput, { Masks } from 'react-native-mask-input';


// Category Select List
const sports = [
    {
      label: 'Football',
      value: 'football',
    },
    {
      label: 'Baseball',
      value: 'baseball',
    },
    {
      label: 'Hockey',
      value: 'hockey',
    },
];

// Conditions Options
const condition_radio_props = [
    {
        label: 'Produto Novo', 
        value: 0,
    },
    {
        label: 'Usado, estado de Novo',
        value: 1,
    },
    {
        label: 'Usado, com Detalhes',
        value: 2,
    },
    {
        label: 'Para Restauração/Reuso',
        value: 3,
    }
];

// Has NF Options
const nf_radio_props = [
    {
        label: 'Sim', 
        value: 0,
    },
    {
        label: 'Não', 
        value: 1,
    }
];

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

// Input Msg Model
const ErrorMsg = (props) => {
    return(
        <Text style = { [ 
            css.textRed, 
            css.size12, 
            css.m_OneTop, 
            css.m_OneLeft 
        ] }>
            {props.msg}
        </Text>
    );
};

const NewTradePost = (props) => {

    // Form
    const [titleInput       , setTitleInput]        = useState(null);
    const [categoryInput    , setCategoryInput]     = useState(null);
    const [brandInput       , setBrandInput]        = useState(null);
    const [modelInput       , setModelInput]        = useState(null);
    const [colorInput       , setColorInput]        = useState(null);
    const [priceInput       , setPriceInput]        = useState(null);
    const [descriptionInput , setDescriptionInput]  = useState(null);
    const [conditionInput   , setConditionInput]    = useState(0);
    const [hasNFInput       , setHasNFInput]        = useState(0);

    // Error Msg
    const [errorMessage  , setErrorMessage]     = useState(null);

    // User Logged Data (useEffect)
    const [userEmail        , setUserEmail]     = useState(null);
    const [userProfilePic   , setProfilePic]    = useState(null);
    const [userPass         , setUserPass]      = useState(null);
    const [userId           , setUserID]        = useState(null);
    const [userName         , setUserName]      = useState(null);

    // Loading Bool
    const [isLoading  , setIsLoading]   = useState(false);
    
    // Form Style/Validation
    const [isFocused    , setFocused]   = useState(false);        
    
    const [titleError       , setTitleError]    = useState(null);
    const [categoryError    , setCategoryError] = useState(null);
    const [brandError       , setBrandError]    = useState(null);
    const [modelError       , setModelError]    = useState(null);    
    const [priceError       , setPriceError]    = useState(null);    

    const placeholderCategory = {
        label: 'Selecionar Categoria',
        value: null,
        color: '#9EA0A4',
    };

    const placeholderBrand = {
        label: 'Selecionar Marca',
        value: null,
        color: '#9EA0A4',
    };
    
    const placeholderModel = {
        label: 'Selecionar Modelo',
        value: null,
        color: '#9EA0A4',
    };
    
    const placeholderColor = {
        label: 'Selecionar Cor',
        value: null,
        color: '#9EA0A4',
    };

    // New Trade Post Function
    async function InsertNewTP() {

        let isError = false;

        // Validations
        // Title
        if ( titleInput === "" || titleInput === null ) {
            setTitleError(true);
            isError = true;
        } else {            
            setTitleError(false);
        }

        // Category        
        if ( categoryInput === "" || categoryInput === null ) {
            setCategoryError(true);
            isError = true;
        } else {
            setCategoryError(false);
        }

        // Brand
        if ( brandInput === "" || brandInput === null ) {
            setBrandError(true);
            isError = true;
        } else {
            setBrandError(false);
        }
                
        // Model
        if ( modelInput === "" || modelInput === null ) {
            setModelError(true);
            isError = true;
        } else {            
            setModelError(false);
        }        
        
        // Price
        if ( priceInput === "" || priceInput === null ) {
            setPriceError(true);
            isError = true;
        } else {
            setPriceError(false);
        }

        if ( isError ) return false;

        console.log("Formulário Validado!");

        // console.log("Título: " + titleInput);
        // console.log("Categoria: " + categoryInput);
        // console.log("Marca: " + brandInput);
        // console.log("Modelo: " + modelInput);
        // console.log("Cor: " + colorInput);
        // console.log("R$: " +priceInput);
        // console.log("Descrição: " + descriptionInput);
        // console.log("Condição: " + conditionInput);
        // console.log("Possui NF? " + hasNFInput );
        // console.log("**********************************");        

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
                    title="NOVO ANÚNCIO"                
                    userName={null}
                    userPhotoURL={null}
                    navigation={props.navigation}
                    isLoggedUser={false}
                    hideRightIcon={true}
                />
                
                {isLoading && <LoadingIcon />}                

                {/* Briefing */}
                <View style={ [ css.centerVerticaly, { height: 50 } ]}>
                    <View style={css.centerVerticaly}>
                        <Animatable.View animation="fadeInLeft" delay={300}>
                            <Text style={ [ 
                                css.textLightgray, 
                                css.centerSelf ,
                                css.m_FourTop
                            ]}>
                            Preencha os dados abaixo para Publicar um novo Item:
                            </Text>
                        </Animatable.View>
                    </View>
                </View>            
                
                {/* Form */}
                <View style={ [ css.flexThree, css.m_FourBottom ]}>
                    <Animatable.View animation="fadeInUp" style={ [ css.m_Three ]}>                    
                                            
                        {/* API Error Messages */}
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

                                {/* Title */}
                                <View style = { [ css.m_Three ] }>
                                    <TextInput
                                        placeholder="Título"
                                        maxLength={35}
                                        style={css.inputDefault}
                                        onChangeText={text=>setTitleInput(text)}
                                    />
                                    { !!titleError && 
                                        <ErrorMsg 
                                            msg="Por favor, preencha o campo Título"
                                        />
                                    }
                                </View>

                                {/* Category */}
                                <View style = { [ css.m_Three ] }>
                                    <RNPickerSelect
                                        placeholder={placeholderCategory}
                                        items={sports}
                                        onValueChange={value => {
                                            setCategoryInput(value);
                                        }}
                                        style={{
                                            ...pickerSelectStyles,
                                            iconContainer: {
                                                top: 12,
                                                right: 10,
                                            },
                                            placeholder: {
                                                color: '#9EA0A4',
                                            },
                                        }}
                                        // value={this.state.favSport4}
                                        useNativeAndroidPickerStyle={false}
                                        textInputProps={{ underlineColor: 'yellow' }}
                                        Icon={() => {
                                            return <Entypo name="chevron-small-down" size={28} color="gray" />;
                                        }}
                                    />
                                    { !!categoryError && 
                                        <ErrorMsg 
                                            msg="Por favor, preencha o campo Título"
                                        />
                                    }
                                </View>

                                {/* Brand */}
                                <View style = { [ css.m_Three ] }>
                                    <RNPickerSelect
                                        placeholder={placeholderBrand}
                                        items={sports}
                                        onValueChange={value => {
                                            setBrandInput(value);
                                        }}
                                        style={{
                                            ...pickerSelectStyles,
                                            iconContainer: {
                                                top: 12,
                                                right: 10,                                           
                                            },
                                            placeholder: {
                                                color: '#9EA0A4',
                                            },
                                        }}                                        
                                        useNativeAndroidPickerStyle={false}
                                        textInputProps={{ underlineColor: 'yellow' }}
                                        Icon={() => {
                                            return <Entypo name="chevron-small-down" size={28} color="gray" />;
                                        }}
                                    />
                                    { !!brandError && 
                                        <ErrorMsg 
                                            msg="Por favor, preencha o campo Marca"
                                        />
                                    }
                                </View>

                                {/* Model */}
                                <View style = { [ css.m_Three ] }>
                                    <RNPickerSelect
                                        placeholder={placeholderModel}
                                        items={sports}
                                        onValueChange={value => {
                                            setModelInput(value);
                                        }}
                                        style={{
                                            ...pickerSelectStyles,
                                            iconContainer: {
                                                top: 12,
                                                right: 10,                                           
                                            },
                                            placeholder: {
                                                color: '#9EA0A4',
                                            },
                                        }}
                                        useNativeAndroidPickerStyle={false}
                                        textInputProps={{ underlineColor: 'yellow' }}
                                        Icon={() => {
                                            return <Entypo name="chevron-small-down" size={28} color="gray" />;
                                        }}
                                    />
                                    { !!modelError && 
                                        <ErrorMsg 
                                            msg="Por favor, preencha o campo Modelo"
                                        />
                                    }
                                </View>

                                {/* Color */}
                                <View style = { [ css.m_Three ] }>
                                    <RNPickerSelect
                                        placeholder={placeholderColor}
                                        items={sports}
                                        onValueChange={value => {
                                            setColorInput(value);
                                        }}
                                        style={{
                                            ...pickerSelectStyles,
                                            iconContainer: {
                                                top: 12,
                                                right: 10,                                           
                                            },
                                            placeholder: {
                                                color: '#9EA0A4',
                                            },
                                        }}
                                        // value={this.state.favSport4}
                                        useNativeAndroidPickerStyle={false}
                                        textInputProps={{ underlineColor: 'yellow' }}
                                        Icon={() => {
                                            return <Entypo name="chevron-small-down" size={28} color="gray" />;
                                        }}
                                    />
                                </View>                              
                                
                                {/* Price */}
                                <View style = { [ css.m_Three ] }>
                                    <MaskInput
                                        maxLength={12}
                                        keyboardType="number-pad"
                                        value={priceInput}
                                        style={ [ css.inputDefault ] }
                                        onChangeText={(masked, unmasked) => {

                                            var finalValue = unmasked;                                        

                                            // Add '.' character
                                            if ( unmasked.length > 2 ) {
                                                var valueOne = '';
                                                var valueTwo = '';
                                                
                                                valueOne = finalValue.substring(0, finalValue.length-2);
                                                valueTwo = ('.' + finalValue.slice(-2));

                                                finalValue = valueOne + valueTwo;                                            
                                            }

                                            setPriceInput(finalValue);
                                        }}
                                        mask={Masks.BRL_CURRENCY}
                                    />
                                    { !!priceError && 
                                        <ErrorMsg 
                                            msg="Por favor, preencha o Preço do Item"
                                        />
                                    }
                                </View>

                                {/* Description */}
                                <TextInput
                                    placeholder="Descrição do Anúncio"
                                    multiline={true}
                                    numberOfLines={4}
                                    maxLength={255}
                                    style={ [ 
                                        css.inputTextArea(isFocused),
                                        css.m_Three,
                                        css.p_Two,
                                    ] }
                                    onChangeText={text=>setDescriptionInput(text)}
                                    onFocus={()=>{                                        
                                        setFocused(true);
                                    }}
                                    onEndEditing={(e) => {
                                        var text = e.nativeEvent.text;
                                        if ( text == '' ) {
                                            setFocused(false);
                                        } else {
                                            return null;
                                        }
                                    }}
                                />
                                
                                {/* Condition */}
                                <View style={ [ css.m_Three ] }>
                                    <Text style = { [ css.textWhite, css.size16, css.m_TwoY, css.centerText, css.fontBold ] }>
                                        Estado de Uso
                                    </Text>
                                    <RadioForm
                                        radio_props={condition_radio_props}
                                        initial={0}                                        
                                        formHorizontal={false}
                                        labelHorizontal={true}
                                        buttonColor={'#eb1f36'}
                                        selectedButtonColor={'#eb1f36'}
                                        selectedLabelColor={'#fff'}
                                        labelColor={'#fff'}
                                        animation={true}
                                        style={ [ css.m_ThreeTop ] }
                                        labelStyle={ [ css.m_FourBottom, css.m_OneTop ] }
                                        onPress={(value) => {
                                            // console.log(value)
                                            setConditionInput(value)                                            
                                        }}
                                    />
                                </View>                            
                                
                                {/* Has NF ? */}
                                <View style={ [ css.m_Three ] }>
                                    <Text style = { [ css.textWhite, css.size16, css.m_TwoY, css.centerText, css.fontBold ] }>
                                        Possui Nota Fiscal?
                                    </Text>
                                    <RadioForm
                                        radio_props={nf_radio_props}
                                        initial={0}                                        
                                        formHorizontal={true}
                                        labelHorizontal={true}
                                        buttonColor={'#eb1f36'}
                                        selectedButtonColor={'#eb1f36'}
                                        selectedLabelColor={'#fff'}
                                        labelColor={'#fff'}
                                        animation={true}
                                        style={ [ css.m_ThreeTop ] }
                                        labelStyle={ [ css.m_FourBottom, css.m_OneTop, { width: '50%' } ] }
                                        onPress={(value) => {
                                            setHasNFInput(value);                                            
                                        }}
                                    />
                                </View>

                            </View>
                        </View>

                        {/* Bottom of Page */}
                        <View>
                            <View style = { [ css.m_ThreeY, css.p_ThreeY ] }>
                                <TouchableOpacity
                                    style={ [css.buttonDefault, css.p_TwoY, { width: '55%' }] }
                                    onPress={()=>InsertNewTP()}
                                    // onPress={()=>{Alert.alert("Função em Desenvolvimento!")}}
                                >
                                    <Text style={ [css.size18, css.textWhite, css.fontBold] }>
                                        PUBLICAR
                                    </Text>
                                </TouchableOpacity>
                            </View>
                        
                            <View style = { [ css.m_FourTop ] }>
                                <TouchableOpacity
                                    onPress={()=>props.navigation.navigate('SignIn')}
                                >
                                    <Text style={ [css.textWhite, css.centerText] }>
                                        Para ver seus Anúncios, Clique <Text style={ [ css.fontBold, css.underlineText ] }>Aqui</Text>
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

export default NewTradePost;