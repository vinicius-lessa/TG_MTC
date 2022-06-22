# MTC-MobileApp
<Description>

- Frontend EntryPoint: App.js
<!-- - Backend EntryPoint: Controller.js -->

# NODE MODULES (used within the project)    
- expo CLI
    - Description: Expo is a set of tools built around React Native
    - command: $ npm install -g expo-cli (https://reactnative.dev/docs/environment-setup)

- react Navigation
    - Description: React Navigation is made up of some core utilities and those are then used by navigators to create the navigation structure in your app.
    - commands:
        Base
        - $ npm install @react-navigation/native (https://reactnavigation.org/docs/getting-started)
        
        Dependencies
        - $ expo install react-native-screens react-native-safe-area-context (https://reactnavigation.org/docs/getting-started)

        Others
        - $ npm install @react-navigation/native-stack (https://reactnavigation.org/docs/hello-react-navigation)
        - $ npm install @react-navigation/drawer (https://reactnavigation.org/docs/drawer-navigator/)
        - $ expo install react-native-gesture-handler react-native-reanimated (https://reactnavigation.org/docs/drawer-navigator/ - https://docs.swmansion.com/react-native-gesture-handler/)
            ** Necessário Adicionar plugin no arquivo babel.config.js **

- expo AppLoadging
    - Description: Utilizado no Root do projeto (App.js) para validar o carregamento das fontes customizadas
    - command: $ expo install expo-app-loading

- API Sauce
    - Description: ... (TradePost.js)
    - command: $ npm i apisauce --save

- Async Storage
    - Description: An asynchronous, persistent, key-value storage system for React Native.
    - Docs: https://react-native-async-storage.github.io/async-storage/docs/install/
    - Git Source: https://github.com/react-native-async-storage/async-storage
    - command: $ expo install @react-native-async-storage/async-storage

- EAS Cli
    - Description: EAS Build is a new and rapidly evolving service.
    - Docs: https://docs.expo.dev/build/setup/ (App Store) - https://docs.expo.dev/build-reference/apk/ (APK)
    - command: $ npm install -g eas-cli

- Picker Select
    - Description: A Picker component for React Native which emulates the native <select> interfaces for iOS and Android.
    - Docs: https://www.npmjs.com/package/react-native-picker-select - https://github.com/lawnstarter/react-native-picker-select#styling
    - command(s): 
        - $ npm install react-native-picker-select
        - # Expo
        - $ expo install @react-native-picker/picker

- Radio Input
    - Description: Simple and useful radio button component for React Native.
    - Docs: https://www.npmjs.com/package/react-native-simple-radio-button
    - command(s):
        - $ npm i react-native-simple-radio-button --save

- React Native Mask Input
    - Description: A simple and effective Text Input with mask for ReactNative on iOS, Android, and Web.
    - Docs: https://www.npmjs.com/package/react-native-mask-input - https://github.com/CaioQuirinoMedeiros/react-native-mask-input
    - command(s):
        - $ npm install react-native-mask-input